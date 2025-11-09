<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Doctor;
use App\Models\DoctorAvailability;
use App\Models\DoctorSlot;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DoctorController extends Controller
{
    // ---------------------------
    // Doctor CRUD
    // ---------------------------
    public function index()
    {
        $doctors = Doctor::orderBy('id', 'DESC')->paginate(10); // ✅ Add paginate
        return view('admin.doctors.index', compact('doctors'));
    }


    public function create()
    {
        return view('admin.doctors.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'specialization' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255|unique:doctors,email',
            'phone' => 'nullable|string|max:20|unique:doctors,phone',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'rating' => 'nullable|numeric|between:0,5',
            'experience_years' => 'nullable|integer|min:0',
        ]);

        $data = $request->only(['name', 'specialization', 'email', 'phone', 'rating', 'experience_years']);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('doctors', 'public');
        }

        Doctor::create($data);

        return redirect()->route('admin.doctors.index')->with('success', 'Doctor created successfully.');
    }

    public function edit(Doctor $doctor)
    {
        return view('admin.doctors.edit', compact('doctor'));
    }

    public function update(Request $request, Doctor $doctor)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'specialization' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255|unique:doctors,email,' . $doctor->id,
            'phone' => 'nullable|string|max:20|unique:doctors,phone,' . $doctor->id,
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'rating' => 'nullable|numeric|between:0,5',
            'experience_years' => 'nullable|integer|min:0',
        ]);

        $data = $request->only(['name', 'specialization', 'email', 'phone', 'rating', 'experience_years']);

        if ($request->hasFile('image')) {
            if ($doctor->image && \Storage::disk('public')->exists($doctor->image)) {
                \Storage::disk('public')->delete($doctor->image);
            }
            $data['image'] = $request->file('image')->store('doctors', 'public');
        }

        $doctor->update($data);

        return redirect()->route('admin.doctors.index')->with('success', 'Doctor updated successfully.');
    }

    public function destroy(Doctor $doctor)
    {
        if ($doctor->image && \Storage::disk('public')->exists($doctor->image)) {
            \Storage::disk('public')->delete($doctor->image);
        }
        $doctor->delete();

        return redirect()->route('admin.doctors.index')->with('success', 'Doctor deleted successfully.');
    }

    // ---------------------------
    // Availability & Slots
    // ---------------------------
    public function showAvailabilityForm(Doctor $doctor)
    {
        return view('admin.doctors.availability', compact('doctor'));
    }

    public function saveAvailability(Request $request, Doctor $doctor)
    {
        $request->validate([
            'availability' => 'required|array',
            'weeks' => 'nullable|integer|min:1|max:4',
        ]);

        $data = $request->input('availability', []);
        $weeks = (int)$request->input('weeks', 1);

        $weekDays = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];

        DB::transaction(function () use ($doctor, $data, $weeks, $weekDays) {
            foreach ($data as $day => $details) {
                $startTime = $details['start_time'] ?? null;
                $endTime = $details['end_time'] ?? null;
                $slotDuration = isset($details['slot_duration']) ? (int)$details['slot_duration'] : 30;
                $isActive = isset($details['is_active']) ? true : false;

                if (!$startTime || !$endTime) continue;
                if (Carbon::parse($startTime)->gte(Carbon::parse($endTime))) continue;

                $availability = $doctor->availabilities()->updateOrCreate(
                    ['day_of_week' => $day],
                    [
                        'start_time' => $startTime,
                        'end_time' => $endTime,
                        'slot_duration' => $slotDuration,
                        'is_active' => $isActive
                    ]
                );

                // Remove future inactive slots
                if (!$isActive) {
                    $doctor->slots()
                        ->where('date', '>=', now()->toDateString())
                        ->where('start_time', '>=', $startTime)
                        ->where('end_time', '<=', $endTime)
                        ->delete();
                    continue;
                }

                // Generate slots for upcoming weeks
                for ($week = 0; $week < $weeks; $week++) {
                    $nextDate = Carbon::now()->next($day)->addWeeks($week);

                    $currentTime = Carbon::parse($startTime);
                    $endTimeCarbon = Carbon::parse($endTime);

                    while ($currentTime->lt($endTimeCarbon)) {
                        $slotEndTime = $currentTime->copy()->addMinutes($slotDuration);
                        if ($slotEndTime->gt($endTimeCarbon)) break;

                        if ($nextDate->isToday() && $currentTime->lt(now())) {
                            $currentTime->addMinutes($slotDuration);
                            continue;
                        }

                        $exists = $doctor->slots()
                            ->where('date', $nextDate->toDateString())
                            ->where('start_time', $currentTime->format('H:i:s'))
                            ->exists();

                        if (!$exists) {
                            $doctor->slots()->create([
                                'date' => $nextDate->toDateString(),
                                'start_time' => $currentTime->format('H:i:s'),
                                'end_time' => $slotEndTime->format('H:i:s'),
                            ]);
                        }

                        $currentTime->addMinutes($slotDuration);
                    }

                    // Automatic Sunday night slot
                    if ($day === 'Sunday') {
                        $sundayNight = $nextDate->copy()->setTime(20, 0); // 8 PM
                        if (!$doctor->slots()->where('date', $nextDate->toDateString())
                            ->where('start_time', $sundayNight->format('H:i:s'))
                            ->exists()) {
                            $doctor->slots()->create([
                                'date' => $nextDate->toDateString(),
                                'start_time' => $sundayNight->format('H:i:s'),
                                'end_time' => $sundayNight->copy()->addMinutes($slotDuration)->format('H:i:s'),
                            ]);
                        }
                    }
                }
            }
        });

        return redirect()->back()->with('success', 'Availability and slots saved successfully for upcoming weeks.');
    }

    // ---------------------------
    // Generate Slots for Future Weeks (Manual Button)
    // ---------------------------
    public function generateSlots(Doctor $doctor, int $weeks = 1)
    {
        $activeAvailabilities = $doctor->availabilities()->where('is_active', true)->get();
        $weekDays = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];

        DB::transaction(function () use ($doctor, $activeAvailabilities, $weeks, $weekDays) {
            $startDate = Carbon::now()->startOfWeek();
            if (Carbon::now()->isSunday()) $startDate->addWeek();

            for ($week = 0; $week < $weeks; $week++) {
                for ($i = 0; $i < 7; $i++) {
                    $date = $startDate->copy()->addWeek($week)->addDays($i);
                    $dayName = $date->format('l');
                    $dayAvailabilities = $activeAvailabilities->where('day_of_week', $dayName);

                    foreach ($dayAvailabilities as $availability) {
                        $start = Carbon::parse($availability->start_time);
                        $end = Carbon::parse($availability->end_time);
                        $existingSlots = $doctor->slots()
                            ->where('date', $date->toDateString())
                            ->get()
                            ->map(fn($slot) => [
                                'start' => Carbon::parse($slot->start_time),
                                'end' => Carbon::parse($slot->end_time),
                            ]);

                        while ($start->lt($end)) {
                            $slotEnd = $start->copy()->addMinutes((int)$availability->slot_duration);
                            $overlap = $existingSlots->first(fn($s) => $start->lt($s['end']) && $slotEnd->gt($s['start']));
                            if (!$overlap) {
                                $doctor->slots()->create([
                                    'date' => $date->toDateString(),
                                    'start_time' => $start->toTimeString(),
                                    'end_time' => $slotEnd->toTimeString(),
                                ]);
                            }
                            $start->addMinutes((int)$availability->slot_duration);
                        }

                        // Sunday night slot
                        if ($dayName === 'Sunday') {
                            $sundayNight = $date->copy()->setTime(20, 0);
                            if (!$doctor->slots()->where('date', $date->toDateString())
                                ->where('start_time', $sundayNight->format('H:i:s'))
                                ->exists()) {
                                $doctor->slots()->create([
                                    'date' => $date->toDateString(),
                                    'start_time' => $sundayNight->format('H:i:s'),
                                    'end_time' => $sundayNight->copy()->addMinutes($availability->slot_duration)->format('H:i:s'),
                                ]);
                            }
                        }
                    }
                }
            }
        });
    }

    // ---------------------------
    // All Slots Page
    // ---------------------------
    public function allSlots(Request $request)
    {
        $query = DoctorSlot::with(['doctor', 'appointments']);

        if ($request->doctor_id) {
            $query->where('doctor_id', $request->doctor_id);
        }

        if ($request->date) {
            $query->where('date', $request->date);
        }

        if ($request->status) {
            if ($request->status === 'booked') {
                $query->whereHas('appointments');
            } elseif ($request->status === 'available') {
                $query->whereDoesntHave('appointments');
            }
        }

        $slots = $query->whereHas('doctor')
            ->where('date', '>=', now()->toDateString())
            ->orderBy('date')
            ->orderBy('start_time')
            ->paginate(10) // ✅ Pagination added
            ->appends($request->query()); // ✅ Keeps filters when changing pages

        $doctors = Doctor::all();

        return view('admin.slots.all', compact('slots', 'doctors'));
    }




    public function deleteSlot(DoctorSlot $slot)
    {
        if ($slot->appointments()->count() > 0) {
            return redirect()->back()->with('error', 'Cannot delete slot with booked appointments.');
        }

        $slot->delete();
        return redirect()->back()->with('success', 'Slot deleted successfully.');
    }
}
