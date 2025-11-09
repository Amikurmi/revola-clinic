<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Specialist extends Component
{
    public string $title;
    public string $description;
    public string $doctorName;
    public string $doctorField;
    public string $doctorImage;
    public string $mainImage;

    /**
     * Create a new component instance.
     */
    public function __construct(
        string $title = 'Our Leading Specialist Take Care Of You!',
        string $description = 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry’s standard dummy.',
        string $doctorName = 'Dr. Shraddha Katkar',
        string $doctorField = 'M.B.B.S., M.D. [ Skin & V.D.]',
        string $doctorImage = 'images/katkar1.jpg',
        string $mainImage = 'images/katkar1.jpg'
    ) {
        $this->title = $title;
        $this->description = $description;
        $this->doctorName = $doctorName;
        $this->doctorField = $doctorField;
        $this->doctorImage = $doctorImage;
        $this->mainImage = $mainImage;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.specialist');
    }
}
