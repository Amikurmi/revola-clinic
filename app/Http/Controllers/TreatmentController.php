<?php

namespace App\Http\Controllers;

use App\Models\Treatment;

class TreatmentController extends Controller
{
    public function index()
    {
        // Show 6 treatments per page
        $treatments = Treatment::latest()->paginate(6);
        return view('treatments.index', compact('treatments'));
    }

    public function show($slug)
    {
        $treatment = Treatment::where('slug', $slug)->firstOrFail();

        // Fetch 3 related treatments (excluding current)
        $relatedTreatments = Treatment::where('id', '!=', $treatment->id)
            ->inRandomOrder()
            ->take(3)
            ->get();

        return view('user.treatments.show', compact('treatment', 'relatedTreatments'));
    }
}
