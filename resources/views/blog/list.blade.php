@extends('layout.master')

@section('content')
    <section class="pt-24 pb-16 bg-gray-600 min-h-screen">
        <div class="max-w-7xl mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($blogs as $blog)
                    <x-blog-card :blog="$blog" />
                @endforeach
            </div>

            {{ $blogs->links() }}
        </div>
    </section>
@endsection
