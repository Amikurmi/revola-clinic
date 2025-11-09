<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Doctor;
use App\Models\Service;
use App\Models\Treatment;
use App\Models\DoctorSlot;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class UserAppointmentController extends Controller
{
    // ---------------------------
    // List all appointments for logged-in user
    // ---------------------------
    public function index()
    {
        $appointments = Appointment::with(['doctor', 'slot'])
            ->where('user_id', auth()->id())
            ->orderBy('created_at', 'desc')
            ->get();

        foreach ($appointments as $appointment) {
            if (
                $appointment->slot &&
                \Carbon\Carbon::parse($appointment->slot->date . ' ' . $appointment->slot->start_time)->isPast() &&
                $appointment->status === 'pending'
            ) {
                $appointment->isExpired = true;
            } else {
                $appointment->isExpired = false;
            }
        }

        return view('user.appointments.index', compact('appointments'));
    }


    public function summary(Appointment $appointment)
    {
        // Ensure the Appointment belongs to the logged user
        if ($appointment->user_id !== auth()->id()) {
            abort(403, 'Unauthorized access.');
        }

        // Load related data
        $appointment->load(['doctor', 'slot']);

        return view('user.appointments.summary', compact('appointment'));
    }




    // ---------------------------
    // Show booking form
    // ---------------------------
    public function create()
    {
        $doctors = Doctor::all();

        // Static services
        $staticServices = ['Consultation'];

        // Dynamic from Service Model
        $services = Service::pluck('title', 'id');

        // Treatments from Treatment Model
        $treatments = Treatment::pluck('title', 'id');

        // Branches
        $branches = [
            'Revola Skin and Hair Clinic, 1st Floor, Block No. B-1, Srinivas Apartment, Bajaj Nagar, Nagpur, Maharashtra 440010'
        ];

        return view('user.appointments.create', compact('doctors', 'staticServices', 'services', 'treatments', 'branches'));
    }


    // ---------------------------
    // Fetch available slots for a doctor (AJAX)
    // ---------------------------
    public function getDoctorSlots(Doctor $doctor)
    {
        $now = now();

        $slots = $doctor->slots()
            ->withCount('appointments')
            ->where(function ($query) use ($now) {
                $query->whereDate('date', '>', $now)
                    ->orWhere(function ($q) use ($now) {
                        $q->whereDate('date', $now)
                            ->whereTime('start_time', '>', $now->format('H:i:s'));
                    });
            })
            ->get()
            ->map(fn($slot) => [
                'id' => $slot->id,
                'date' => $slot->date,
                'start_time' => $slot->start_time,
                'end_time' => $slot->end_time,
                'remaining' => $slot->max_patients - $slot->appointments_count,
            ]);

        return response()->json($slots);
    }


    // ---------------------------
    // Store a new appointment
    // ---------------------------
    public function store(Request $request)
    {
        $request->validate([
            'doctor_id' => 'required|exists:doctors,id',
            'slot_id' => 'required|exists:doctor_slots,id',
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'age' => 'required|integer|min:1|max:120',
            'email' => 'required|email|max:255',
            'mobile' => 'required|string|max:20',
            'address' => 'required|string|max:255',
            'service' => 'required|string|max:255',
            'branch' => 'required|string|max:255',
            'message' => 'nullable|string',
        ]);

        $slot = DoctorSlot::withCount('appointments')->findOrFail($request->slot_id);
        $slotDateTime = Carbon::parse($slot->date . ' ' . $slot->start_time);

        if ($slotDateTime->isPast()) {
            return back()->withErrors(['slot_id' => 'You cannot select a past slot.']);
        }

        if ($slot->appointments_count >= $slot->max_patients) {
            return back()->withErrors(['slot_id' => 'This slot is fully booked. Please choose another slot.']);
        }

        // Prevent duplicate booking for same slot
        $existing = Appointment::where('user_id', Auth::id())
            ->where('slot_id', $request->slot_id)
            ->first();

        if ($existing) {
            return back()->withErrors(['slot_id' => 'You have already booked this slot.']);
        }

        Appointment::create([
            'user_id' => Auth::id(),
            'doctor_id' => $request->doctor_id,
            'slot_id' => $request->slot_id,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'age' => $request->age,
            'email' => $request->email,
            'mobile' => $request->mobile,
            'address' => $request->address,
            'service' => $request->service,
            'branch' => $request->branch,
            'message' => $request->message,
            'status' => 'pending',
        ]);

        return redirect()->route('user.appointments.index')->with('success', 'Appointment booked successfully!');
    }

    // ---------------------------
    // Edit form for rescheduling
    // ---------------------------
    public function edit(Appointment $appointment)
    {
        $this->authorizeUser($appointment);
        $now = now();

        $slots = DoctorSlot::withCount('appointments')
            ->where(function ($query) use ($now) {
                $query->whereDate('date', '>', $now)
                    ->orWhere(function ($q) use ($now) {
                        $q->whereDate('date', $now)
                            ->whereTime('start_time', '>', $now->format('H:i:s'));
                    });
            })
            ->get()
            ->filter(fn($slot) => $slot->appointments_count < $slot->max_patients)
            ->sortBy(['date', 'start_time']);

        return view('user.appointments.edit', compact('appointment', 'slots'));
    }

    // ---------------------------
    // Update appointment (reschedule)
    // ---------------------------
    public function update(Request $request, Appointment $appointment)
    {
        $this->authorizeUser($appointment);

        $request->validate(['slot_id' => 'required|exists:doctor_slots,id']);

        $slot = DoctorSlot::withCount('appointments')->findOrFail($request->slot_id);
        $slotDateTime = Carbon::parse($slot->date . ' ' . $slot->start_time);

        if ($slotDateTime->isPast()) {
            return back()->withErrors(['slot_id' => 'You cannot select a past slot.']);
        }

        if ($slot->appointments_count >= $slot->max_patients) {
            return back()->withErrors(['slot_id' => 'This slot is fully booked. Please choose another slot.']);
        }

        $existing = Appointment::where('user_id', Auth::id())
            ->where('slot_id', $request->slot_id)
            ->first();

        if ($existing) {
            return back()->withErrors(['slot_id' => 'You have already booked this slot.']);
        }

        $appointment->update(['slot_id' => $request->slot_id]);

        return redirect()->route('user.appointments.index')->with('success', 'Appointment rescheduled successfully!');
    }

    // ---------------------------
    // Cancel appointment
    // ---------------------------
    public function destroy(Appointment $appointment)
    {
        $this->authorizeUser($appointment);
        $slotDateTime = Carbon::parse($appointment->slot->date . ' ' . $appointment->slot->start_time);

        if ($slotDateTime->isPast()) {
            return back()->withErrors(['error' => 'Cannot cancel past appointments.']);
        }

        $appointment->delete();

        return redirect()->route('user.appointments.index')->with('success', 'Appointment cancelled successfully.');
    }

    // ---------------------------
    // Treatment page (after confirmation)
    // ---------------------------
    public function treatment(Appointment $appointment)
    {
        $this->authorizeUser($appointment);

        if ($appointment->status !== 'confirmed') {
            abort(403, 'You can only access treatment once appointment is confirmed.');
        }

        // Prepare Date and Time
        $date = \Carbon\Carbon::parse($appointment->slot->date);
        $startTime = \Carbon\Carbon::parse($appointment->slot->start_time);
        $endTime = \Carbon\Carbon::parse($appointment->slot->end_time);

        $startDateTime = $date->copy()->setTimeFrom($startTime)->format('Ymd\THis');
        $endDateTime = $date->copy()->setTimeFrom($endTime)->format('Ymd\THis');

        // Google Calendar Event Details
        $title = urlencode("Treatment Session - " . $appointment->service);
        $description = urlencode("Appointment with Dr. {$appointment->doctor->name} at Revola Skin & Hair Clinic.");
        $location = urlencode($appointment->branch . " - Revola Skin & Hair Clinic");

        // Google Calendar Link
        $calendarLink = "https://calendar.google.com/calendar/render?action=TEMPLATE" .
            "&text={$title}" .
            "&dates={$startDateTime}/{$endDateTime}" .
            "&details={$description}" .
            "&location={$location}" .
            "&sf=true&output=xml";

        return view('user.appointments.treatment', compact('appointment', 'calendarLink'));
    }


    // ---------------------------
    // Helper: ensure logged-in user owns the appointment
    // ---------------------------
    private function authorizeUser(Appointment $appointment)
    {
        if ($appointment->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }
    }
}
