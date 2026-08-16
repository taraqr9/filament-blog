<?php

namespace App\Http\Controllers;

use App\Enums\BlogStatus;
use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\View\View;

class BlogController extends Controller
{
    public function index(Request $request): View
    {
        $blogs = Blog::where('status', BlogStatus::Published)
            ->orderByDesc('created_at')
            ->paginate(20)
            ->appends($request->query());

        return view('blog.list', compact('blogs'));
    }

    public function show($slug): View
    {
        $blog = Blog::with(['user', 'images', 'audios'])
            ->where('slug', $slug)
            ->where('status', BlogStatus::Published)
            ->firstOrFail();

        $blogs = Blog::where('status', BlogStatus::Published)
            ->where('id', '!=', $blog->id)
            ->inRandomOrder()
            ->take(3)
            ->get();

        return view('blog.show', compact('blog', 'blogs'));
    }
}
