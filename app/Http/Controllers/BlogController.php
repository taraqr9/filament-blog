<?php

namespace App\Http\Controllers;

use App\Enums\BlogStatus;
use App\Enums\Status;
use App\Models\Blog;
use App\Models\Category;
use App\Models\Subscriber;
use Illuminate\Http\RedirectResponse;
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

    public function show($slug): View
    {
        $blog = Blog::where('slug', $slug)
            ->where('status', BlogStatus::Published)
            ->first();

        $blogs = $blog->category->blogs()
            ->where('status', BlogStatus::Published)
            ->inRandomOrder()
            ->take(3)
            ->get();

        if ($blogs->count() < 3) {
            $remainingBlogsCount = 3 - $blogs->count();

            $randomBlogs = Blog::where('status', BlogStatus::Published)
                ->inRandomOrder()
                ->take($remainingBlogsCount)
                ->get();

            $blogs = $blogs->merge($randomBlogs);
        }

        return view('blog.show', compact('blog', 'blogs'));
    }

    public function subscribe(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'email' => 'required|email',
        ]);

        $subscribe = Subscriber::where('email', $request->email)
            ->first();

        if (! $subscribe) {
            Subscriber::create($data);
        }

        if ($subscribe && $subscribe->status === Status::InActive) {
            $subscribe->update(['status' => Status::Active]);
        }

        return redirect()->back()->with('toast', config('message.subscriber.success'));
    }

    public function unsubscribe(Request $request): View
    {
        $data = $request->validate([
            'email' => 'required|email',
        ]);

        $email = $data['email'];

        return view('unsubscribe', compact('email'));
    }

    public function unsubscribeConfirm(Request $request): RedirectResponse
    {
        $unsubscribe = Subscriber::where('email', $request->email)->first();

        if ($unsubscribe && $unsubscribe->status === Status::Active) {
            $unsubscribe->update([
                'status' => Status::InActive,
            ]);

            return back()->with('toast', config('message.unsubscribe.success'));
        }

        return back()->with('toast', config('message.unsubscribe.not-found'));
    }
}
