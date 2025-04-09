<?php

namespace App\View\Components;

use Illuminate\View\Component;

class BlogCard extends Component
{
    public $blog;

    public function __construct($blog)
    {
        $this->blog = $blog;
    }

    public function render()
    {
        return view('components.blog-card');
    }
}
