@extends('layout.master')

@section('content')
    <section class="pt-24 pb-16 bg-gray-600 min-h-screen">
        <div class="max-w-7xl mx-auto px-4">
            <div class="flex justify-end mb-4">
                <div class="inline-flex items-center bg-white px-4 py-2 rounded-full shadow-md space-x-2">
                    @if (!empty($category?->name))
                        <a href="{{ route('blog.index', ['slug' => null]) }}"
                           class="text-gray-500 hover:text-red-600 text-xl font-bold leading-none">
                            &times;
                        </a>
                    @endif
                    <h2 class="text-base font-semibold text-center">
                        {{ $category->name ?? 'All' }}
                    </h2>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach($blogs as $blog)
                    <div class="bg-white p-6 rounded-lg hover:shadow-gray-400 hover:shadow-lg transition">
                        <a href="{{ route('blog.show', $blog->slug) }}">
                            <img
                                src="{{ $blog->thumbnail ? url('storage/'.$blog->thumbnail) : asset('images/thumbnail.jpg') }}"
                                alt="Thumbnail" class="rounded-md mb-4 shadow-gray-600 shadow-lg hover:shadow-gray-500">
                        </a>
                        <h3 class="text-lg font-semibold">{{ Str::limit($blog->title, 25) }}</h3>
                        <p class="text-gray-600">{!! Str::limit($blog->content, 50) !!}</p>
                        <a href="{{ route('blog.show', $blog->slug) }}"
                           class="text-blue-600 hover:underline mt-2 block">Read more</a>
                    </div>
                @endforeach
            </div>

            {{ $blogs->links() }}
        </div>
    </section>
@endsection
