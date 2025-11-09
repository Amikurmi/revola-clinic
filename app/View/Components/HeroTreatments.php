<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class HeroTreatments extends Component
{
    public string $title1;
    public string $subtitle1;
    public string $buttonText1;
    public string $image1;

    public string $title2;
    public string $subtitle2;
    public string $buttonText2;
    public string $image2;

    public ?string $title3;
    public ?string $subtitle3;
    public ?string $buttonText3;
    public ?string $image3;

    /**
     * Create a new component instance.
     */
    public function __construct(
        string $title1,
        string $subtitle1,
        string $buttonText1,
        string $image1,
        string $title2,
        string $subtitle2,
        string $buttonText2,
        string $image2,
        ?string $title3 = null,
        ?string $subtitle3 = null,
        ?string $buttonText3 = null,
        ?string $image3 = null,
    ) {
        $this->title1 = $title1;
        $this->subtitle1 = $subtitle1;
        $this->buttonText1 = $buttonText1;
        $this->image1 = $image1;

        $this->title2 = $title2;
        $this->subtitle2 = $subtitle2;
        $this->buttonText2 = $buttonText2;
        $this->image2 = $image2;

        $this->title3 = $title3;
        $this->subtitle3 = $subtitle3;
        $this->buttonText3 = $buttonText3;
        $this->image3 = $image3;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.hero-treatments');
    }
}
