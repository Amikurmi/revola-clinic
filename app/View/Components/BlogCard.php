<?php

namespace App\View\Components;

use Illuminate\View\Component;

class BlogCard extends Component
{
    public $title;
    public $date;
    public $excerpt;
    public $image;
    public $link;

    /**
     * Create a new component instance.
     *
     * @param string $title
     * @param string $date
     * @param string $excerpt
     * @param string $image
     * @param string $link
     */
    public function __construct($title = '', $date = '', $excerpt = '', $image = '', $link = '#')
    {
        $this->title = $title;
        $this->date = $date;
        $this->excerpt = $excerpt;
        $this->image = $image;
        $this->link = $link;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.blog-card');
    }
}
