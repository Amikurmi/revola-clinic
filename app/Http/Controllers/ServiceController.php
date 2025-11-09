<?php

namespace App\Http\Controllers;

use App\Models\Service;



class ServiceController extends Controller
{

    public function index()
    {
        // ✅ Don’t use ->toArray()
        $services = Service::orderBy('created_at', 'desc')->get();

        return view('user.services.index', compact('services'));
    }

    public function show($slug)
    {
        $service = Service::where('slug', $slug)->firstOrFail();
        return view('user.services.show', compact('service'));
    }
}
