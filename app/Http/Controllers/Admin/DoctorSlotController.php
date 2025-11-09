<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Doctor;
use App\Models\DoctorSlot;
use Illuminate\Http\Request;
use Carbon\Carbon;

class DoctorSlotController extends Controller
{
    // List all slots
    public function index()
    {
        // Order slots by date and start time
        $slots = DoctorSlot::with('doctor')
            ->orderBy('date')
            ->orderBy('start_time')
            ->get();

        return view('admin.slots.index', compact('slots'));
    }

    // Show form to create a slot
    public function create()
    {
        $doctors = Doctor::all();
        return view('admin.slots.create', compact('doctors'));
    }

    // Store new slot
    public function store(Request $request)
    {
        $request->validate([
            'doctor_id' => 'required|exists:doctors,id',
            'date' => ['required', 'date'],
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
            'max_patients' => 'required|integer|min:1|max:255',
        ]);

        $slotDateTime = Carbon::parse($request->date . ' ' . $request->start_time);
        if ($slotDateTime->isPast()) {
            return back()->withErrors(['date' => 'The selected date and time must be in the future.']);
        }

        DoctorSlot::create($request->all());

        return redirect()->route('admin.slots.index')->with('success', 'Slot created successfully.');
    }

    // Show form to edit slot
    public function edit(DoctorSlot $slot)
    {
        $doctors = Doctor::all();
        $appointments_count = $slot->appointments()->count();

        return view('admin.slots.edit', compact('slot', 'doctors', 'appointments_count'));
    }

    // Update slot
    public function update(Request $request, DoctorSlot $slot)
    {
        $request->validate([
            'doctor_id' => 'required|exists:doctors,id',
            'date' => ['required', 'date'],
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
            'max_patients' => ['required', 'integer', 'min:1', 'max:255'],
        ]);

        $slotDateTime = Carbon::parse($request->date . ' ' . $request->start_time);
        if ($slotDateTime->isPast()) {
            return back()->withErrors(['date' => 'The selected date and time must be in the future.']);
        }

        // Ensure max_patients >= already booked appointments
        $bookedCount = $slot->appointments()->count();
        if ($request->max_patients < $bookedCount) {
            return back()->withErrors([
                'max_patients' => "Max patients cannot be less than already booked appointments ($bookedCount)."
            ]);
        }

        $slot->update($request->all());

        return redirect()->route('admin.slots.index')->with('success', 'Slot updated successfully.');
    }

    // Delete slot
    public function destroy(DoctorSlot $slot)
    {
        // Prevent deleting slots with existing appointments
        if ($slot->appointments()->count() > 0) {
            return back()->withErrors(['error' => 'Cannot delete slot with existing appointments.']);
        }

        $slot->delete();

        return redirect()->route('admin.slots.index')->with('success', 'Slot deleted successfully.');
    }
}
