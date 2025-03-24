<?php

namespace App\Http\Controllers;

use App\Enums\BlogStatus;
use App\Models\Blog;

class HomeController extends Controller
{
    public function index()
    {
        $latest_blogs = Blog::where('status', BlogStatus::Published)->latest()->limit(3)->get();

        return view('home', compact('latest_blogs'));
    }
}
