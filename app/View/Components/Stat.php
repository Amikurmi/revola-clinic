<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Stat extends Component
{
    public string $number;
    public string $label;

    /**
     * Create a new component instance.
     *
     * @param string $number
     * @param string $label
     */
    public function __construct(string $number, string $label)
    {
        $this->number = $number;
        $this->label = $label;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.stat');
    }
}
