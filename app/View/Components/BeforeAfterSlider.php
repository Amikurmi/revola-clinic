<?php

namespace App\View\Components;

use Illuminate\View\Component;

class BeforeAfterSlider extends Component
{
    public $label;
    public $title;
    public $description;
    public $items;

    public function __construct($label = null, $title = null, $description = null, $items = [])
    {
        $this->label = $label;
        $this->title = $title;
        $this->description = $description;
        $this->items = $items;
    }

    public function render()
    {
        return view('components.before-after-slider');
    }
}
