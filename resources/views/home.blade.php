@extends('layout.master')

@section('content')
    <section class="relative overflow-hidden">
        <div class="absolute inset-0 bg-gradient-to-b from-theme-surface to-theme-bg"></div>

        <div class="relative max-w-container mx-auto px-4 py-24 sm:py-32 text-center">
            <h1 class="text-4xl sm:text-5xl font-extrabold tracking-tight text-theme-ink">
                Stories worth listening to
            </h1>
            <p class="mt-4 text-lg text-theme-body max-w-xl mx-auto">
                Read the article, or press play and let the audio guide take you there &mdash; in the language you
                choose.
            </p>
            <a href="#latest"
               class="mt-8 inline-flex items-center gap-2 rounded-full bg-theme-primary px-6 py-3 text-sm font-bold text-white hover:bg-theme-primary-dark transition-colors">
                Explore blogs
                <svg class="size-4" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M3 10a.75.75 0 01.75-.75h10.638L10.23 5.29a.75.75 0 111.04-1.08l5.5 5.25a.75.75 0 010 1.08l-5.5 5.25a.75.75 0 11-1.04-1.08l4.158-3.96H3.75A.75.75 0 013 10z" clip-rule="evenodd" />
                </svg>
            </a>
        </div>
    </section>

    <section id="latest" class="max-w-container mx-auto px-4 py-12 sm:py-16">
        <div class="flex items-end justify-between mb-8">
            <h2 class="text-2xl sm:text-3xl font-extrabold text-theme-ink tracking-tight">Latest posts</h2>
            <a href="{{ route('blog.index') }}"
               class="text-sm font-semibold text-theme-primary hover:text-theme-primary-dark transition-colors">See
                all &rarr;</a>
        </div>

        @if ($latest_blogs->isEmpty())
            <div class="rounded-theme border border-theme-line bg-theme-surface p-12 text-center text-theme-muted">
                No blog posts yet. Check back soon.
            </div>
        @else
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($latest_blogs as $blog)
                    <x-blog-card :blog="$blog" />
                @endforeach
            </div>
        @endif
    </section>
@endsection
