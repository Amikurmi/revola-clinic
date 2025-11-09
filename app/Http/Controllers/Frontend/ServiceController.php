<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Service;

class ServiceController extends Controller
{
    /**
     * Display a listing of all services
     */
    public function index()
    {
        // You can order by latest or title if needed
        $services = Service::latest()->get();

        return view('services', compact('services'));
    }

    /**
     * Display the specified service by slug
     */
    public function show($slug)
    {
        $service = Service::where('slug', $slug)->firstOrFail();

        return view('serviceDetails', compact('service'));
    }
}
