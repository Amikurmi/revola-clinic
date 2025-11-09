<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\Treatment;

class HomeController extends Controller
{
    public function index()
    {
        $services = Service::latest()->get();

        // Use paginate WITHOUT get()
        $treatments = Treatment::latest()->paginate(6);

        return view('home', compact('services', 'treatments'));
    }
}
