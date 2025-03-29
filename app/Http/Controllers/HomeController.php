<?php

namespace App\Http\Controllers;

use App\Enums\BlogStatus;
use App\Models\Blog;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        $latest_blogs = Blog::where('status', BlogStatus::Published)->latest()->limit(3)->get();

        return view('home', compact('latest_blogs'));
    }

    public function about(): View
    {
        return view('user.about');
    }
}
