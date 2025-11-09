<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Button extends Component
{
    public string $bg;
    public string $color;
    public string $class;

    /**
     * Create a new component instance.
     *
     * @param string $bg Background color
     * @param string $color Text color
     * @param string $class Additional CSS classes
     */
    public function __construct(string $bg = '#b18457', string $color = 'white', string $class = '')
    {
        $this->bg = $bg;
        $this->color = $color;
        $this->class = $class;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.button');
    }
}
