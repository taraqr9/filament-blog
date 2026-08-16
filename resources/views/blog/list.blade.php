@extends('layout.master')

@section('content')
    <section class="max-w-container mx-auto px-4 py-12 sm:py-16">
        <div class="mb-10">
            <h1 class="text-3xl sm:text-4xl font-extrabold text-theme-ink tracking-tight">All Blogs</h1>
            <p class="mt-2 text-theme-muted">Stories and audio guides, all in one place.</p>
        </div>

        @if ($blogs->isEmpty())
            <div class="rounded-theme border border-theme-line bg-theme-surface p-12 text-center text-theme-muted">
                No blog posts yet. Check back soon.
            </div>
        @else
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($blogs as $blog)
                    <x-blog-card :blog="$blog" />
                @endforeach
            </div>

            <div class="mt-10">
                {{ $blogs->links() }}
            </div>
        @endif
    </section>
@endsection
