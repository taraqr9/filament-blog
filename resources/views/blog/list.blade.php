@extends('layout.master')

@section('content')
    <section class="pt-24 pb-16 bg-gray-600 min-h-screen">
        <div class="max-w-7xl mx-auto px-4">
            <div class="flex justify-between">
                <div>
                    <h2 class="text-3xl font-bold text-white text-center mb-8">Latest Blog Posts</h2>
                </div>
                <div>
                    <h2>If any</h2>
                </div>
            </div>

            <!-- Blog Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">

                @foreach($blogs as $blog)
                    <div class="bg-white p-6 rounded-lg hover:shadow-slate-400 hover:shadow-lg transition">
                        <img src="{{ asset('images/thumbnail.jpg') }}" alt="Thumbnail" class="rounded-md mb-4">
                        <h3 class="text-lg font-semibold">Best Practices for Prototyping 333</h3>
                        <p class="text-gray-600">Learn how to create effective design prototypes.</p>
                        <a href="#" class="text-blue-600 hover:underline mt-2 block">Read more</a>
                    </div>
                @endforeach


            </div>

            {{ $blogs->links() }}
        </div>
    </section>
@endsection
