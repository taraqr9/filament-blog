<?php

namespace App\Http\Controllers;

use App\Enums\BlogStatus;
use App\Enums\Status;
use App\Models\Blog;
use App\Models\Category;
use App\Models\Subscriber;
use Exception;
use Illuminate\Http\Request;
use Illuminate\View\View;

class BlogController extends Controller
{
    public function index(Request $request): View
    {
        $blogs = Blog::query();
        $category = null;

        if ($request->slug) {
            $category = Category::where('slug', $request->slug)->where('status', Status::Active)->first();

            if ($category) {
                $blogs = $category->blogs();
            }
        }

        $blogs = $blogs->where('status',
            BlogStatus::Published)->orderByDesc('created_at')->paginate(20)->appends($request->query());

        return view('blog.list', compact('blogs', 'category'));
    }

    public function show($slug)
    {
        try {
            $blog = Blog::where('slug', $slug)
                ->where('status', BlogStatus::Published)
                ->first();

            return view('blog.show', compact('blog'));
        } catch (Exception $error) {
            //            $message = 'Message : '.$e->getMessage().', File : '.$e->getFile().', Line : '.$e->getLine();

            //            https://www.youtube.com/watch?v=eTOScyTCkiY&ab_channel=LaravelDaily // watch later

            dd($error);

            return redirect()->back()->with('toast', config('message.error'));
        }

    }

    public function subscribe(Request $request)
    {
        $data = $request->validate([
            'email' => 'required|email|unique:subscribers,email',
        ]);

        try {
            Subscriber::create($data);

            return redirect()->back()->with('toast', config('message.subscriber.success'));
        } catch (Exception $e) {
            return redirect()->back()->with('toast', config('message.error'));
        }

    }
}
