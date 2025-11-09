<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class TreatmentCard extends Component
{
    public string $image;
    public string $title;
    public ?string $label;
    public ?string $description;
    public ?string $button;
    public string $mt; // Added mt property

    /**
     * Create a new component instance.
     *
     * @param string $image
     * @param string $title
     * @param string|null $label
     * @param string|null $description
     * @param string|null $button
     * @param string $mt
     */
    public function __construct(
        string $image,
        string $title,
        string $label = null,
        string $description = null,
        string $button = null,
        string $mt = '2' // default mt-2
    ) {
        $this->image = $image;
        $this->title = $title;
        $this->label = $label;
        $this->description = $description;
        $this->button = $button;
        $this->mt = $mt;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.treatment-card');
    }
}
