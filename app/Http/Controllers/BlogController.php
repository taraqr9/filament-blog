<?php

namespace App\Http\Controllers;

use App\Enums\BlogStatus;
use App\Enums\Status;
use App\Models\Blog;
use App\Models\Category;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index(Request $request)
    {
        $blogs = Blog::query();
        $category = null;

        if ($request->slug) {
            $category = Category::where('slug', $request->slug)->where('status', Status::Active)->first();

            if ($category) {
                $blogs = $category->blogs()
                    ->where('status', BlogStatus::Published);
            }
        }

        $blogs = $blogs->orderByDesc('created_at')->paginate(20)->appends($request->query());

        return view('blog.list', compact('blogs', 'category'));
    }
}
