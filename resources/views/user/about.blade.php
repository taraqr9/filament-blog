@extends('layout.master')

@section('content')
    <section class="max-w-container mx-auto px-4 pt-8 sm:pt-12">
        <x-hero-carousel :images="$slider_images" />
    </section>

    <section class="max-w-container mx-auto px-4 py-12 sm:py-16 text-center">
        <span class="inline-flex items-center gap-2 text-xs sm:text-sm font-semibold uppercase tracking-[0.35em] text-theme-primary">
            <span class="h-px w-8 bg-theme-primary/50"></span>
            About
            <span class="h-px w-8 bg-theme-primary/50"></span>
        </span>
        <h1 class="mt-6 text-4xl sm:text-5xl font-extrabold tracking-tight text-theme-ink max-w-2xl mx-auto">
            About Tashfia Tabassum
        </h1>

        <div class="mt-8 max-w-2xl mx-auto space-y-5 text-left text-theme-body leading-relaxed">
            <p>
                Welcome! This is Tashfia Tabassum's personal website &mdash; a space for sharing stories, thoughts,
                and updates.
            </p>
            <p>
                More details about Tashfia will be added here soon.
            </p>
        </div>

        <a href="{{ route('blog.index') }}"
           class="mt-10 inline-flex items-center gap-2 rounded-full bg-theme-primary px-8 py-3.5 text-sm font-bold text-white shadow-theme-lg hover:bg-theme-primary-dark hover:scale-[1.03] transition-all">
            Explore blogs
            <svg class="size-4" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M3 10a.75.75 0 01.75-.75h10.638L10.23 5.29a.75.75 0 111.04-1.08l5.5 5.25a.75.75 0 010 1.08l-5.5 5.25a.75.75 0 11-1.04-1.08l4.158-3.96H3.75A.75.75 0 013 10z" clip-rule="evenodd" />
            </svg>
        </a>
    </section>
@endsection
