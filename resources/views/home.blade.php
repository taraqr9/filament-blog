@extends('layout.master')

@php
    $heroImages = [
        'images/pantheon-hero/ext-1.jpg',
        'images/pantheon-hero/int-1.jpg',
        'images/pantheon-hero/ext-2.jpg',
        'images/pantheon-hero/int-2.jpg',
        'images/pantheon-hero/ext-3.jpg',
        'images/pantheon-hero/int-3.jpg',
        'images/pantheon-hero/ext-4.jpg',
        'images/pantheon-hero/int-4.jpg',
        'images/pantheon-hero/ext-5.jpg',
        'images/pantheon-hero/int-5.jpg',
    ];
@endphp

@section('content')
    <section id="hero-carousel" class="relative h-[520px] sm:h-[620px] lg:h-[680px] overflow-hidden">
        @foreach ($heroImages as $index => $image)
            <img src="{{ asset($image) }}" alt="The Pantheon in Rome"
                 class="hero-slide absolute inset-0 h-full w-full object-cover transition-opacity duration-1000 ease-in-out {{ $index === 0 ? 'opacity-100' : 'opacity-0' }}">
        @endforeach

        <div class="absolute inset-0 bg-gradient-to-b from-black/60 via-black/40 to-theme-bg"></div>

        <div class="relative h-full max-w-container mx-auto px-4 flex flex-col items-center justify-center text-center">
            <h1 class="text-4xl sm:text-5xl font-extrabold tracking-tight text-white">
                Stories worth listening to
            </h1>
            <p class="mt-4 text-lg text-white/80 max-w-xl mx-auto">
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

        <div class="absolute bottom-5 inset-x-0 flex items-center justify-center gap-1.5">
            @foreach ($heroImages as $index => $image)
                <span class="hero-dot size-1.5 rounded-full transition-colors {{ $index === 0 ? 'bg-white' : 'bg-white/40' }}"></span>
            @endforeach
        </div>

        <a href="https://commons.wikimedia.org" target="_blank" rel="noopener"
           class="absolute bottom-2 right-3 text-[11px] text-white/50 hover:text-white/80 transition-colors">
            Photos: Wikimedia Commons
        </a>
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

@section('JScript')
    <script>
        (function () {
            if (window.__heroCarouselInitialized) return;
            window.__heroCarouselInitialized = true;

            const slides = document.querySelectorAll('.hero-slide');
            const dots = document.querySelectorAll('.hero-dot');
            if (slides.length < 2) return;

            let active = 0;

            function render() {
                slides.forEach((slide, i) => {
                    slide.style.opacity = i === active ? '1' : '0';
                });
                dots.forEach((dot, i) => {
                    dot.classList.toggle('bg-white', i === active);
                    dot.classList.toggle('bg-white/40', i !== active);
                });
            }

            render();

            setInterval(function () {
                active = (active + 1) % slides.length;
                render();
            }, 3000);
        })();
    </script>
@endsection
