<?php

namespace App\View\Components;

use Illuminate\View\Component;

class CountryCard extends Component
{
    public $title;
    public $image;
    public $bgColor;

    public function __construct($title, $image = null, $bgColor = '#d9cbb6')
    {
        $this->title = $title;
        $this->image = $image;
        $this->bgColor = $bgColor;
    }

    public function render()
    {
        return view('components.country-card');
    }
}
