<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Hero extends Component
{
    public string $title;
    public string $chat;
    public string $highlight;
    public string $subtitle;
    public string $leftImage;
    public string $rightImage;

    /**
     * Create a new component instance.
     *
     * @param string $title Main heading
     * @param string $highlight Highlighted text
     * @param string $subtitle Subtext/paragraph
     * @param string $leftImage Icon image on left side
     * @param string $rightImage Main visual on right side
     */
    public function __construct(
        string $title = 'Chat',
        string $chat = 'With Our',
        string $highlight = 'Dermatologist',
        string $subtitle = 'A Dermatologist Is A Medical Doctor Who Specializes In The Diagnosis, Treatment, And Prevention Of Skin, Hair, And Nail Conditions.',
        string $leftImage = 'images/katkar.jpg',
        string $rightImage = 'images/herokatkar.png'
    ) {
        $this->title = $title;
        $this->chat = $chat;
        $this->highlight = $highlight;
        $this->subtitle = $subtitle;
        $this->leftImage = $leftImage;
        $this->rightImage = $rightImage;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.hero');
    }
}
