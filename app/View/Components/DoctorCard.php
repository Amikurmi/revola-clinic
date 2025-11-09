<?php

namespace App\View\Components;

use Illuminate\View\Component;

class DoctorCard extends Component
{
    public $image;
    public $name;
    public $specialization;
    public $rating;

    public function __construct($image, $name, $specialization, $rating)
    {
        $this->image = $image;
        $this->name = $name;
        $this->specialization = $specialization;
        $this->rating = $rating;
    }

    public function render()
    {
        return view('components.doctor-card');
    }
}
