@php use App\Helper\Common; @endphp
@extends('layout.master')

@php
    $galleryPaths = collect([$blog->thumbnail])
        ->filter()
        ->concat($blog->images->pluck('image_path'))
        ->values();
@endphp

@section('content')
    <article class="max-w-container mx-auto px-4 py-10 sm:py-14">
        <header class="max-w-4xl mx-auto text-center mb-8">
            <h1 class="text-3xl sm:text-4xl font-extrabold text-theme-ink tracking-tight">{{ $blog->title }}</h1>

            <div class="mt-4 flex items-center justify-center gap-3">
                <img class="size-9 rounded-full object-cover"
                     src="{{ $blog->user->avatar ? url('storage/'.$blog->user->avatar) : asset('images/person.png') }}"
                     alt="{{ $blog->user->name }}">
                <div class="text-left">
                    <p class="text-sm font-semibold text-theme-ink">{{ $blog->user->name }}</p>
                    <time class="text-xs text-theme-muted">{{ Common::dateTimeFormat($blog->created_at) }}</time>
                </div>
            </div>
        </header>

        @if ($galleryPaths->isNotEmpty())
            <div class="max-w-4xl mx-auto mb-10">
                <div id="blog-carousel"
                     class="relative aspect-video sm:aspect-[16/8] rounded-theme overflow-hidden border border-theme-line bg-theme-surface">
                    @foreach ($galleryPaths as $index => $path)
                        <img src="{{ url('storage/'.$path) }}" alt="{{ $blog->title }}"
                             style="opacity: {{ $index === 0 ? 1 : 0 }}; transform: scale({{ $index === 0 ? 1.08 : 1 }});"
                             class="blog-slide absolute inset-0 h-full w-full object-cover will-change-transform transition-[opacity,transform] duration-[1200ms,6000ms] ease-out">
                    @endforeach

                    @if ($galleryPaths->count() > 1)
                        <button type="button" id="carousel-prev" aria-label="Previous image"
                                class="absolute left-3 top-1/2 -translate-y-1/2 size-10 rounded-full bg-black/50 backdrop-blur-md text-white flex items-center justify-center hover:bg-black/70 transition-colors">
                            <svg class="size-7" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                            </svg>
                        </button>
                        <button type="button" id="carousel-next" aria-label="Next image"
                                class="absolute right-3 top-1/2 -translate-y-1/2 size-10 rounded-full bg-black/50 backdrop-blur-md text-white flex items-center justify-center hover:bg-black/70 transition-colors">
                            <svg class="size-7" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                            </svg>
                        </button>

                        <div id="carousel-dots" class="absolute bottom-3 inset-x-0 flex items-center justify-center gap-2">
                            @foreach ($galleryPaths as $index => $path)
                                <button type="button" data-index="{{ $index }}"
                                        class="carousel-dot h-1.5 rounded-full transition-all duration-500 {{ $index === 0 ? 'w-8 bg-white' : 'w-1.5 bg-white/40' }}"
                                        aria-label="Go to image {{ $index + 1 }}"></button>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        @endif

        <div class="max-w-4xl mx-auto prose-theme leading-relaxed">
            {!! $blog->content !!}
        </div>
    </article>

    @if ($blogs->isNotEmpty())
        <section class="border-t border-theme-line">
            <div class="max-w-container mx-auto px-4 py-12 sm:py-16">
                <h2 class="text-2xl font-extrabold text-theme-ink tracking-tight mb-8 text-center">Read more</h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach ($blogs as $related)
                        <x-blog-card :blog="$related" />
                    @endforeach
                </div>
            </div>
        </section>
    @endif
@endsection

@section('JScript')
    <script>
        (function () {
            const container = document.getElementById('blog-carousel');
            if (!container) return;

            const slides = container.querySelectorAll('.blog-slide');
            const dots = document.querySelectorAll('.carousel-dot');
            const prevBtn = document.getElementById('carousel-prev');
            const nextBtn = document.getElementById('carousel-next');
            if (slides.length < 2) return;

            let active = 0;
            let timer;

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

            function goTo(index) {
                active = (index + slides.length) % slides.length;
                render();
            }

            function restartTimer() {
                clearInterval(timer);
                timer = setInterval(() => goTo(active + 1), 3000);
            }

            prevBtn?.addEventListener('click', () => {
                goTo(active - 1);
                restartTimer();
            });
            nextBtn?.addEventListener('click', () => {
                goTo(active + 1);
                restartTimer();
            });
            dots.forEach((dot) => dot.addEventListener('click', () => {
                goTo(parseInt(dot.dataset.index, 10));
                restartTimer();
            }));

            render();
            restartTimer();
        })();
    </script>
@endsection
