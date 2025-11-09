<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Navbar extends Component
{
    public string $logo;
    public array $links; // associative array: ['Home' => 'home', ...]
    public string $phone;
    public string $hours;

    /**
     * Create a new component instance.
     *
     * @param string $logo
     * @param array $links
     * @param string $phone
     * @param string $hours
     */
    public function __construct(
        string $logo = '/images/logo.png',
        array $links = ['Home' => 'home', 'About' => 'about', 'Services' => 'services', 'Blogs' => 'blogs', 'Packages' => 'packages', 'Contact' => 'contact'],
        string $phone = '7030319520',
        string $hours = 'Mon - Sun 10:00 AM To 08:00 PM'
    ) {
        $this->logo = $logo;
        $this->links = $links;
        $this->phone = $phone;
        $this->hours = $hours;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.navbar');
    }
}
