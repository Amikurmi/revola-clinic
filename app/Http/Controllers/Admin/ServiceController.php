<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Service;
use Illuminate\Support\Str;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::orderBy('id', 'desc')->paginate(10);
        return view('admin.services.index', compact('services'));
    }

    public function view(Service $service)
    {
        return view('admin.services.view', compact('service'));
    }

    public function create()
    {
        return view('admin.services.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'image' => 'nullable|image'
        ]);

        $service = new Service();
        $service->title = $request->title;
        $service->label = $request->label;
        $service->description = $request->description;
        $service->slug = Str::slug($request->title);
        $service->button = $request->button ?? 'View Services';

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('services', 'public');
            $service->image = '/storage/' . $path;
        }

        $service->save();

        return redirect()->route('admin.services.index')->with('success', 'Service added successfully.');
    }

    // ✅ ADD THIS (You Removed It Earlier)
    public function edit(Service $service)
    {
        return view('admin.services.edit', compact('service'));
    }

    public function update(Request $request, Service $service)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'image' => 'nullable|image'
        ]);

        $service->title = $request->title;
        $service->label = $request->label;
        $service->description = $request->description;
        $service->slug = Str::slug($request->title);
        $service->button = $request->button ?? 'View Services';

        // ✅ Handle Image Update
        if ($request->hasFile('image')) {

            // Delete old image
            if ($service->image && file_exists(public_path($service->image))) {
                @unlink(public_path($service->image));
            }

            // Upload new image
            $path = $request->file('image')->store('services', 'public');
            $service->image = '/storage/' . $path;
        }

        $service->save();

        return redirect()->route('admin.services.index')->with('success', 'Service updated successfully.');
    }

    public function destroy(Service $service)
    {
        $service->delete();
        return redirect()->route('admin.services.index')->with('success', 'Service deleted successfully.');
    }
    public function uploadImage(Request $request)
    {
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $path = $file->store('service-description-images', 'public');
            return response()->json(['location' => asset('storage/' . $path)]);
        }

        return response()->json(['error' => 'No file uploaded'], 422);
    }
    public function uploadEditorImage(Request $request)
    {
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('uploads/services', 'public');
            return response()->json(['url' => asset('storage/' . $path)]);
        }
        return response()->json(['error' => 'No image found'], 422);
    }
}
