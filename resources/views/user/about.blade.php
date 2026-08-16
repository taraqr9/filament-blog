@extends('layout.master')

@section('content')
    <section class="max-w-container mx-auto px-4 pt-8 sm:pt-12">
        <x-hero-carousel />
    </section>

    <section class="max-w-container mx-auto px-4 py-12 sm:py-16 text-center">
        <span class="inline-flex items-center gap-2 text-xs sm:text-sm font-semibold uppercase tracking-[0.35em] text-theme-primary">
            <span class="h-px w-8 bg-theme-primary/50"></span>
            About
            <span class="h-px w-8 bg-theme-primary/50"></span>
        </span>
        <h1 class="mt-6 text-4xl sm:text-5xl font-extrabold tracking-tight text-theme-ink max-w-2xl mx-auto">
            The story behind the stories
        </h1>

        <div class="mt-8 max-w-2xl mx-auto space-y-5 text-left text-theme-body leading-relaxed">
            <p>
                Rome rewards the curious &mdash; but its history rarely fits on a plaque. This project was built to
                close that gap: real places, told as stories, with the option to simply press play and let an
                audio guide walk you through it while you look up rather than down at a screen.
            </p>
            <p>
                Every post pairs a written article with a narrated version, recorded in multiple languages, so the
                experience travels with you &mdash; whether you're reading at home before a trip or standing in
                front of the Pantheon with your phone in your pocket and your headphones in.
            </p>
            <p>
                It's a small, growing collection for now. New places and new languages get added as they're
                researched, written, and recorded properly &mdash; not rushed.
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
