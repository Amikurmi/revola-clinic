<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\Treatment;

class AboutController extends Controller
{
    public function index()
    {
        $services = Service::latest()->get();

        return view('about', compact('services'));
    }
}
