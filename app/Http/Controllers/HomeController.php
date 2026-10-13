<?php

namespace App\Http\Controllers;

use App\Enums\BlogStatus;
use App\Models\Blog;
use App\Models\Slider;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        $latest_blogs = Blog::where('status', BlogStatus::Published)->latest()->limit(3)->get();
        $slider_images = $this->activeSliderImages();

        return view('home', compact('latest_blogs', 'slider_images'));
    }

    public function about(): View
    {
        $slider_images = $this->activeSliderImages();

        return view('user.about', compact('slider_images'));
    }

    private function activeSliderImages(): array
    {
        return Slider::where('is_active', true)
            ->orderBy('sort_order')
            ->pluck('image_path')
            ->map(fn (string $path) => asset('storage/'.$path))
            ->all();
    }
}
