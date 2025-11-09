<?php

namespace App\View\Components;

use App\Models\Treatment;
use Illuminate\View\Component;

class TreatmentSection extends Component
{
    public $treatments;

    public function __construct()
    {
        // ✅ Fetch from DB if available, else fallback to defaults
        $this->treatments = Treatment::latest()->take(6)->get();

        // ✅ If DB is empty, use default static data
        if ($this->treatments->isEmpty()) {
            $this->treatments = collect([
                (object)[
                    'image' => 'images/2.jpg',
                    'title' => 'Face Treatments',
                    'slug' => '#',
                    'button' => 'About Services',
                ],
                (object)[
                    'image' => 'images/2.jpg',
                    'title' => 'Skin Treatments',
                    'slug' => '#',
                    'button' => 'About Services',
                ],
                (object)[
                    'image' => 'images/2.jpg',
                    'title' => 'Eye Care Treatments',
                    'slug' => '#',
                    'button' => 'About Services',
                ],
                (object)[
                    'image' => 'images/2.jpg',
                    'title' => 'Scar Removal',
                    'slug' => '#',
                    'button' => 'About Services',
                ],
            ]);
        }
    }

    public function render()
    {
        return view('components.treatment-section');
    }
}
