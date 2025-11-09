<?php

namespace App\View\Components;

use Illuminate\View\Component;

class AwardCard extends Component
{
    public $date;
    public $category;
    public $description;
    public $bgColor;
    public $facebookUrl;
    public $twitterUrl;
    public $instagramUrl;

    /**
     * Create a new component instance.
     */
    public function __construct(
        $date,
        $category,
        $description,
        $bgColor = 'white',
        $facebookUrl = null,
        $twitterUrl = null,
        $instagramUrl = null
    ) {
        // Ensure logo is treated as safe HTML (like an inline SVG)

        $this->date = $date;
        $this->category = $category;
        $this->description = $description;

        $this->bgColor = $bgColor;

        // If no link provided, hide icon instead of linking to "#"
        $this->facebookUrl = $facebookUrl ?: null;
        $this->twitterUrl = $twitterUrl ?: null;
        $this->instagramUrl = $instagramUrl ?: null;
    }

    /**
     * Get the view / contents.
     */
    public function render()
    {
        return view('components.award-card');
    }
}
