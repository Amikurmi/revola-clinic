<?php

namespace App\Http\Controllers;

use App\Models\TreatmentConsultation;
use Illuminate\Http\Request;

class TreatmentConsultationController extends Controller
{
    // Store User Form Submission
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'treatment_id' => 'required|exists:treatments,id',
            'preferred_date' => 'required|date|after:today',
            'contact_number' => 'nullable|string|max:10',
            'email' => 'nullable|email|max:255',
            'message' => 'nullable|string'
        ]);

        TreatmentConsultation::create($validated);

        return back()->with('success', '✅ Your consultation request has been submitted successfully!');
    }


    // Admin View - With Status Filter (No Search)
    public function index(Request $request)
    {
        $filter = $request->filter ?? 'all';

        $consultations = TreatmentConsultation::with('treatment')
            ->when($filter === 'contacted', function ($q) {
                $q->where('status', 1);
            })
            ->when($filter === 'pending', function ($q) {
                $q->where('status', 0);
            })
            ->latest()
            ->paginate(10);

        return view('admin.consultations.index', compact('consultations', 'filter'));
    }


    // Toggle Status (Pending / Contacted)
    public function toggleStatus($id)
    {
        $consultation = TreatmentConsultation::findOrFail($id);
        $consultation->status = !$consultation->status;
        $consultation->save();

        return response()->json(['success' => true]);
    }
}
