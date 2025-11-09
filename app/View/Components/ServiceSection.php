<?php

namespace App\View\Components;

use Illuminate\View\Component;

class ServiceSection extends Component
{
    public $services;

    public function __construct($services = [])
    {
        $this->services = $services ?: [
            ['id' => '01', 'title' => 'Excellent Labrador', 'desc' => 'Lorem Ipsum Is Simply Dummy Text Of The Printing And Typesetting Industry.', 'active' => false],
            ['id' => '02', 'title' => 'World Class Infrastructure', 'desc' => 'Lorem Ipsum Is Simply Dummy Text Of The Printing And Typesetting Industry.', 'active' => false],
            ['id' => '03', 'title' => 'Pharmacy', 'desc' => 'Lorem Ipsum Is Simply Dummy Text Of The Printing And Typesetting Industry.', 'active' => false],
            ['id' => '04', 'title' => 'Cosmetic Surgery', 'desc' => 'Lorem Ipsum Is Simply Dummy Text Of The Printing And Typesetting Industry.', 'active' => false],
            ['id' => '05', 'title' => 'Health Checkups', 'desc' => 'Lorem Ipsum Is Simply Dummy Text Of The Printing And Typesetting Industry.', 'active' => false],
        ];
    }

    public function render()
    {
        return view('components.service-section');
    }
}
