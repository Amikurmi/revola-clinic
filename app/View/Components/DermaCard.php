<?php

namespace App\View\Components;

use Illuminate\View\Component;

class DermaCard extends Component
{
    public $title;
    public $subtitle;
    public $quote;
    public $author;
    public $image;
    public $bgColor;
    public $textColor;

    /**
     * Create a new component instance.
     */
    public function __construct(
        $title = null,
        $subtitle = null,
        $quote = null,
        $author = null,
        $image = null,
        $bgColor = 'bg-white',
        $textColor = 'text-gray-800',
    ) {
        $this->title = $title;
        $this->subtitle = $subtitle;
        $this->quote = $quote;
        $this->author = $author;
        $this->image = $image;
        $this->bgColor = $bgColor;
        $this->textColor = $textColor;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render()
    {
        return view('components.derma-card');
    }
}
