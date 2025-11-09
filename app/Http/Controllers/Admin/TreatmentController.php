<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Treatment;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TreatmentController extends Controller
{
    /**
     * Display a listing of treatments with search and pagination.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');

        $treatments = Treatment::when($search, function ($query, $search) {
            $query->where('title', 'like', "%{$search}%")
                ->orWhere('button', 'like', "%{$search}%");
        })
            ->latest()
            ->paginate(10);

        return view('admin.treatments.index', compact('treatments', 'search'));
    }

    /**
     * Show create treatment form.
     */
    public function create()
    {
        return view('admin.treatments.create');
    }

    public function show($id)
    {
        $treatment = Treatment::findOrFail($id);
        return view('admin.treatments.show', compact('treatment'));
    }

    /**
     * Store new treatment.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'required|image',
            'description' => 'required|string',
        ]);

        $path = $request->file('image')->store('treatments', 'public');

        Treatment::create([
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'button' => $request->button,
            'image' => 'storage/' . $path,
            'short_description' => $request->short_description,
            'description' => $request->description,
        ]);

        return redirect()->route('admin.treatments.index')
            ->with('success', 'Treatment created successfully.');
    }

    /**
     * Show the form for editing treatment.
     */
    public function edit(Treatment $treatment)
    {
        return view('admin.treatments.edit', compact('treatment'));
    }

    /**
     * Update treatment.
     */
    public function update(Request $request, Treatment $treatment)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        $path = $treatment->image;

        if ($request->hasFile('image')) {
            $path = 'storage/' . $request->file('image')->store('treatments', 'public');
        }

        $treatment->update([
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'button' => $request->button,
            'image' => $path,
            'short_description' => $request->short_description,
            'description' => $request->description,
        ]);

        return redirect()->route('admin.treatments.index')
            ->with('success', 'Treatment updated successfully.');
    }

    /**
     * Delete Treatment.
     */
    public function destroy(Treatment $treatment)
    {
        $treatment->delete();
        return back()->with('success', 'Treatment deleted successfully.');
    }

    /**
     * ✅ Image Upload for TinyMCE (Luxury Editor)
     */
    public function uploadImage(Request $request)
    {
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $filename = time() . '-' . $file->getClientOriginalName();
            $file->move(public_path('uploads/treatments'), $filename);

            return response()->json([
                'location' => asset('uploads/treatments/' . $filename)
            ]);
        }

        return response()->json(['error' => 'No file uploaded'], 422);
    }
}
