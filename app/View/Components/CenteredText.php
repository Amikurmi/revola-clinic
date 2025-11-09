<?php

namespace App\View\Components;

use Illuminate\View\Component;

class CenteredText extends Component
{
    public string $line1;
    public string $line2;

    /**
     * Create a new component instance.
     */
    public function __construct(string $line1 = 'Line 1', string $line2 = 'Line 2')
    {
        $this->line1 = $line1;
        $this->line2 = $line2;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render()
    {
        return view('components.centered-text');
    }
}
