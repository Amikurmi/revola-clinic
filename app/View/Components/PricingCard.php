<?php

namespace App\View\Components;

use Illuminate\View\Component;

class PricingCard extends Component
{
    public $title;
    public $price;
    public $duration;
    public $features;
    public $icon;
    public $bgColor;
    public $textColor;
    public $buttonText;
    public $buttonUrl;
    public $image; // optional for consultation card
    public $isImageCard;

    public function __construct(
        $title = '',
        $price = '',
        $duration = '',
        $features = [],
        $icon = '',
        $bgColor = '#E5DFD6',
        $textColor = 'text-gray-800',
        $buttonText = 'Get Started',
        $buttonUrl = '#',
        $image = null,
        $isImageCard = false
    ) {
        $this->title = $title;
        $this->price = $price;
        $this->duration = $duration;
        $this->features = $features;
        $this->icon = $icon;
        $this->bgColor = $bgColor;
        $this->textColor = $textColor;
        $this->buttonText = $buttonText;
        $this->buttonUrl = $buttonUrl;
        $this->image = $image;
        $this->isImageCard = $isImageCard;
    }

    public function render()
    {
        return view('components.pricing-card');
    }
}
