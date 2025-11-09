<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Treatments extends Component
{
    /**
     * Create a new component instance.
     * You can pass dynamic treatments array if needed in future.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.treatments');
    }
}
