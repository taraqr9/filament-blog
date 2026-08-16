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
        <header class="max-w-3xl mx-auto text-center mb-8">
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
            <div class="max-w-3xl mx-auto mb-10">
                <div id="blog-carousel" class="relative rounded-theme overflow-hidden border border-theme-line bg-theme-surface">
                    <div id="carousel-track" class="flex overflow-x-auto snap-x snap-mandatory no-scrollbar scroll-smooth">
                        @foreach ($galleryPaths as $path)
                            <div class="min-w-full snap-center aspect-video sm:aspect-[16/8]">
                                <img src="{{ url('storage/'.$path) }}" alt="{{ $blog->title }}"
                                     class="h-full w-full object-cover">
                            </div>
                        @endforeach
                    </div>

                    @if ($galleryPaths->count() > 1)
                        <button type="button" id="carousel-prev" aria-label="Previous image"
                                class="absolute left-3 top-1/2 -translate-y-1/2 size-9 rounded-full bg-black/50 backdrop-blur-md text-white flex items-center justify-center hover:bg-black/70 transition-colors">
                            <svg class="size-5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                            </svg>
                        </button>
                        <button type="button" id="carousel-next" aria-label="Next image"
                                class="absolute right-3 top-1/2 -translate-y-1/2 size-9 rounded-full bg-black/50 backdrop-blur-md text-white flex items-center justify-center hover:bg-black/70 transition-colors">
                            <svg class="size-5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                            </svg>
                        </button>

                        <div id="carousel-dots" class="absolute bottom-3 inset-x-0 flex items-center justify-center gap-1.5">
                            @foreach ($galleryPaths as $index => $path)
                                <button type="button" data-index="{{ $index }}"
                                        class="carousel-dot size-2 rounded-full bg-white/40 hover:bg-white/70 transition-colors"
                                        aria-label="Go to image {{ $index + 1 }}"></button>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        @endif

        @if ($blog->audios->isNotEmpty())
            <div class="max-w-3xl mx-auto mb-10 rounded-theme border border-theme-line bg-theme-surface p-5 sm:p-6">
                <div class="flex items-center justify-between gap-4 mb-4">
                    <h2 class="text-sm font-semibold text-theme-ink uppercase tracking-wide">Listen to this post</h2>

                    <select id="audio-language"
                            class="rounded-theme-sm border border-theme-line bg-theme-surface-raised text-theme-ink text-sm font-medium px-3 py-2 focus:outline-none focus:ring-2 focus:ring-theme-primary">
                        @foreach ($blog->audios as $audio)
                            <option value="{{ url('storage/'.$audio->audio_path) }}" @selected($loop->first)>
                                {{ $audio->language }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <audio id="audio-player" controls class="w-full" preload="none">
                    <source id="audio-source" src="{{ url('storage/'.$blog->audios->first()->audio_path) }}">
                </audio>
            </div>
        @endif

        <div class="max-w-3xl mx-auto prose-theme leading-relaxed">
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
            const track = document.getElementById('carousel-track');
            if (!track) return;

            const prevBtn = document.getElementById('carousel-prev');
            const nextBtn = document.getElementById('carousel-next');
            const dots = document.querySelectorAll('.carousel-dot');

            function slideWidth() {
                return track.clientWidth;
            }

            function goTo(index) {
                track.scrollTo({left: index * slideWidth(), behavior: 'smooth'});
            }

            function currentIndex() {
                return Math.round(track.scrollLeft / slideWidth());
            }

            function updateDots() {
                const active = currentIndex();
                dots.forEach((dot, i) => {
                    dot.classList.toggle('bg-white', i === active);
                    dot.classList.toggle('bg-white/40', i !== active);
                });
            }

            prevBtn?.addEventListener('click', () => goTo(Math.max(0, currentIndex() - 1)));
            nextBtn?.addEventListener('click', () => goTo(Math.min(dots.length - 1, currentIndex() + 1)));
            dots.forEach((dot) => dot.addEventListener('click', () => goTo(parseInt(dot.dataset.index, 10))));

            let scrollTimeout;
            track.addEventListener('scroll', () => {
                clearTimeout(scrollTimeout);
                scrollTimeout = setTimeout(updateDots, 100);
            });

            updateDots();
        })();

        (function () {
            const select = document.getElementById('audio-language');
            const player = document.getElementById('audio-player');
            const source = document.getElementById('audio-source');
            if (!select || !player || !source) return;

            select.addEventListener('change', function () {
                const wasPlaying = !player.paused;
                source.src = this.value;
                player.load();
                if (wasPlaying) {
                    player.play();
                }
            });
        })();
    </script>
@endsection
