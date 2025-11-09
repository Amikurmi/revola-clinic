<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Doctor;
use App\Models\DoctorSlot;
use Illuminate\Http\Request;
use Carbon\Carbon;

class AppointmentController extends Controller
{
    // ---------------------------
    // List all appointments
    // ---------------------------
    public function index(Request $request)
    {
        $status = $request->query('status');

        $appointments = Appointment::with(['doctor', 'slot', 'user'])
            ->when($status && $status !== 'expired', function ($query) use ($status) {
                return $query->where('status', $status);
            })
            ->orderBy('created_at', 'desc')
            ->get();

        // Tag expired appointments
        foreach ($appointments as $appointment) {
            if (
                $appointment->slot &&
                Carbon::parse($appointment->slot->date)->isPast() &&
                $appointment->status === 'pending'
            ) {
                $appointment->isExpired = true;
            } else {
                $appointment->isExpired = false;
            }
        }

        // Filter only expired (if selected)
        if ($status === 'expired') {
            $appointments = $appointments->where('isExpired', true);
        }

        return view('admin.appointments.index', compact('appointments', 'status'));
    }



    // ---------------------------
    // Create Appointment
    // ---------------------------
    public function create()
    {
        $doctors = Doctor::all();
        $slots = DoctorSlot::whereDate('date', '>=', now())
            ->with('appointments')
            ->orderBy('date')
            ->orderBy('start_time')
            ->get();

        return view('admin.appointments.create', compact('doctors', 'slots'));
    }



    // ---------------------------
    // Show Appointment Details
    // ---------------------------
    public function show(Appointment $appointment)
    {
        $appointment->load(['doctor', 'slot', 'user']);

        // Check expired
        $isExpired = false;
        if ($appointment->slot && $appointment->status === 'pending') {
            if (Carbon::parse($appointment->slot->date)->isPast()) {
                $isExpired = true;
            }
        }

        return view('admin.appointments.show', compact('appointment', 'isExpired'));
    }


    // ---------------------------
    // Store appointment
    // ---------------------------
    public function store(Request $request)
    {
        $data = $this->validateRequest($request);

        // Check if slot is in the future
        $slot = DoctorSlot::findOrFail($request->slot_id);
        $slotDateTime = Carbon::parse($slot->date . ' ' . $slot->start_time);
        if ($slotDateTime->isPast()) {
            return back()->withErrors(['slot_id' => 'You cannot select a past slot.']);
        }

        // Check if slot is already booked
        if ($slot->appointments()->count() > 0) {
            return back()->withErrors(['slot_id' => 'This slot is already booked.']);
        }

        Appointment::create($data);

        return redirect()->route('admin.appointments.index')
            ->with('success', 'Appointment created successfully.');
    }

    // ---------------------------
    // Show form to edit appointment
    // ---------------------------
    public function edit(Appointment $appointment)
    {
        $doctors = Doctor::all();
        $slots = DoctorSlot::whereDate('date', '>=', now())
            ->with('appointments')
            ->orderBy('date')
            ->orderBy('start_time')
            ->get();

        return view('admin.appointments.edit', compact('appointment', 'doctors', 'slots'));
    }

    // ---------------------------
    // Update appointment
    // ---------------------------
    public function update(Request $request, Appointment $appointment)
    {
        $data = $this->validateRequest($request);

        // Check slot validity
        $slot = DoctorSlot::findOrFail($request->slot_id);
        $slotDateTime = Carbon::parse($slot->date . ' ' . $slot->start_time);
        if ($slotDateTime->isPast()) {
            return back()->withErrors(['slot_id' => 'You cannot select a past slot.']);
        }

        // Ensure slot is not already booked by another appointment
        if ($slot->appointments()->where('id', '!=', $appointment->id)->count() > 0) {
            return back()->withErrors(['slot_id' => 'This slot is already booked by another appointment.']);
        }

        $appointment->update($data);

        return redirect()->route('admin.appointments.index')
            ->with('success', 'Appointment updated successfully.');
    }

    // ---------------------------
    // Update status only
    // ---------------------------
    public function updateStatus(Request $request, Appointment $appointment)
    {
        $request->validate([
            'status' => 'required|in:pending,confirmed,completed,cancelled',
        ]);

        $appointment->status = $request->status;
        $appointment->save();

        return back()->with('success', 'Appointment status updated successfully.');
    }

    // ---------------------------
    // Delete appointment
    // ---------------------------
    public function destroy(Appointment $appointment)
    {
        $appointment->delete();
        return redirect()->route('admin.appointments.index')
            ->with('success', 'Appointment deleted successfully.');
    }

    // ---------------------------
    // Request validation helper
    // ---------------------------
    protected function validateRequest(Request $request)
    {
        return $request->validate([
            'user_id' => 'nullable|exists:users,id',
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
            'status' => 'required|in:pending,confirmed,completed',
        ]);
    }
}
