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
    <section id="hero-carousel" class="max-w-container mx-auto px-4 pt-8 sm:pt-12">
        <div class="relative h-[60vh] min-h-[420px] overflow-hidden rounded-theme shadow-theme-lg">
            @foreach ($heroImages as $index => $image)
                <img src="{{ asset($image) }}" alt="The Pantheon in Rome"
                     style="opacity: {{ $index === 0 ? 1 : 0 }}; transform: scale({{ $index === 0 ? 1.08 : 1 }});"
                     class="hero-slide absolute inset-0 h-full w-full object-cover will-change-transform transition-[opacity,transform] duration-[1200ms,6000ms] ease-out">
            @endforeach

            <div class="absolute inset-0 bg-gradient-to-t from-black/50 via-transparent to-transparent"></div>

            <div class="absolute bottom-7 inset-x-0 flex items-center justify-center gap-2">
                @foreach ($heroImages as $index => $image)
                    <span class="hero-dot h-1.5 rounded-full transition-all duration-500 {{ $index === 0 ? 'w-8 bg-white' : 'w-1.5 bg-white/40' }}"></span>
                @endforeach
            </div>

            <a href="https://commons.wikimedia.org" target="_blank" rel="noopener"
               class="absolute bottom-2 right-3 text-[11px] text-white/50 hover:text-white/80 transition-colors">
                Photos: Wikimedia Commons
            </a>
        </div>
    </section>

    <section id="explore" class="max-w-container mx-auto px-4 pt-12 sm:pt-16 text-center">
        <span class="inline-flex items-center gap-2 text-xs sm:text-sm font-semibold uppercase tracking-[0.35em] text-theme-primary">
            <span class="h-px w-8 bg-theme-primary/50"></span>
            Rome &middot; Italy
            <span class="h-px w-8 bg-theme-primary/50"></span>
        </span>
        <h1 class="mt-6 text-4xl sm:text-5xl lg:text-6xl font-extrabold tracking-tight text-theme-ink max-w-3xl mx-auto">
            Stories worth listening to
        </h1>
        <p class="mt-6 text-lg sm:text-xl text-theme-muted max-w-2xl mx-auto">
            Read the article, or press play and let the audio guide take you there &mdash; in the language you
            choose.
        </p>
        <a href="#latest"
           class="mt-10 inline-flex items-center gap-2 rounded-full bg-theme-primary px-8 py-3.5 text-sm font-bold text-white shadow-theme-lg hover:bg-theme-primary-dark hover:scale-[1.03] transition-all">
            Explore blogs
            <svg class="size-4" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M3 10a.75.75 0 01.75-.75h10.638L10.23 5.29a.75.75 0 111.04-1.08l5.5 5.25a.75.75 0 010 1.08l-5.5 5.25a.75.75 0 11-1.04-1.08l4.158-3.96H3.75A.75.75 0 013 10z" clip-rule="evenodd" />
            </svg>
        </a>
    </section>

    <section id="latest" class="max-w-container mx-auto px-4 pt-12 pb-12 sm:pt-16 sm:pb-16">
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
                    const isActive = i === active;
                    slide.style.opacity = isActive ? '1' : '0';
                    slide.style.transform = isActive ? 'scale(1.08)' : 'scale(1)';
                });
                dots.forEach((dot, i) => {
                    const isActive = i === active;
                    dot.classList.toggle('bg-white', isActive);
                    dot.classList.toggle('w-8', isActive);
                    dot.classList.toggle('bg-white/40', !isActive);
                    dot.classList.toggle('w-1.5', !isActive);
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
