@extends('layout.master')

@section('content')
    <section class="relative bg-gray-600 text-white text-center bg-cover bg-center min-h-[100vh]"
             style="background-image: url('/images/home.jpg');">
        <div class="absolute inset-0 bg-black bg-opacity-50 flex flex-col justify-center items-center px-4">
            <h1 class="text-4xl font-extrabold">Welcome to MyBlog</h1>
            <p class="mt-4 text-lg">Discover the latest stories, insights, and ideas.</p>
            <a href="#latest"
               class="mt-6 inline-block bg-white text-blue-600 px-6 py-2 rounded-lg shadow-md hover:bg-gray-700">Explore Now</a>
        </div>
    </section>

    <!-- Latest Blog Posts -->
    <section id="latest" class="bg-gray-600 py-12">
        <div class="max-w-7xl mx-auto px-4">
            <h2 class="text-2xl font-bold mb-6 text-center text-white">Latest Posts</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @foreach($latest_blogs as $blog)
                    <x-blog-card :blog="$blog" />
                @endforeach
            </div>
        </div>
    </section>
@endsection
