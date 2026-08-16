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
            <div class="max-w-4xl mx-auto mb-10 rounded-theme border border-theme-line bg-theme-surface p-5 sm:p-6">
                <div class="flex items-center justify-between gap-4 mb-5">
                    <h2 class="text-sm font-semibold text-theme-ink uppercase tracking-wide">Listen to this post</h2>

                    <select id="audio-language"
                            class="rounded-theme-sm border border-theme-line bg-theme-surface-raised text-theme-ink text-sm font-medium px-3 py-2 focus:outline-none focus:ring-2 focus:ring-theme-primary">
                        @foreach ($blog->audios as $audio)
                            <option value="{{ route('blog.audio', $audio) }}" @selected($loop->first)>
                                {{ $audio->language }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="flex items-center gap-4">
                    <button type="button" id="audio-toggle" aria-label="Play"
                            class="shrink-0 size-12 rounded-full bg-theme-primary text-white flex items-center justify-center hover:bg-theme-primary-dark transition-colors">
                        <svg id="audio-icon-play" class="size-5 translate-x-0.5" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M6.3 4.24a1 1 0 011.51-.86l8.3 5.76a1 1 0 010 1.72l-8.3 5.76A1 1 0 016.3 15.76V4.24z" />
                        </svg>
                        <svg id="audio-icon-pause" class="size-5 hidden" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M6 4.5A1.5 1.5 0 017.5 3h1A1.5 1.5 0 0110 4.5v11A1.5 1.5 0 018.5 17h-1A1.5 1.5 0 016 15.5v-11zM12 4.5A1.5 1.5 0 0113.5 3h1A1.5 1.5 0 0116 4.5v11a1.5 1.5 0 01-1.5 1.5h-1a1.5 1.5 0 01-1.5-1.5v-11z" />
                        </svg>
                    </button>

                    <div class="flex-1 min-w-0">
                        <div id="audio-progress-track"
                             class="relative h-1.5 rounded-full bg-theme-line cursor-pointer group">
                            <div id="audio-progress-fill"
                                 class="absolute inset-y-0 left-0 rounded-full bg-theme-primary" style="width:0%"></div>
                            <div id="audio-progress-handle"
                                 class="absolute top-1/2 -translate-y-1/2 -translate-x-1/2 size-3.5 rounded-full bg-white shadow-theme opacity-0 group-hover:opacity-100 transition-opacity"
                                 style="left:0%"></div>
                        </div>
                        <div class="mt-2 flex justify-between text-xs text-theme-muted tabular-nums">
                            <span id="audio-current-time">0:00</span>
                            <span id="audio-duration">0:00</span>
                        </div>
                    </div>

                    <button type="button" id="audio-mute" aria-label="Mute"
                            class="shrink-0 text-theme-muted hover:text-theme-ink transition-colors">
                        <svg id="audio-icon-volume" class="size-5" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M11 5 6 9H2v6h4l5 4V5Z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 8.5a5 5 0 010 7" />
                        </svg>
                        <svg id="audio-icon-muted" class="size-5 hidden" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M11 5 6 9H2v6h4l5 4V5Z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M17 9l4 6m0-6l-4 6" />
                        </svg>
                    </button>
                </div>

                <audio id="audio-player" preload="metadata" class="hidden">
                    <source id="audio-source" src="{{ route('blog.audio', $blog->audios->first()) }}">
                </audio>
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
            const player = document.getElementById('audio-player');
            if (!player) return;

            const select = document.getElementById('audio-language');
            const source = document.getElementById('audio-source');
            const toggleBtn = document.getElementById('audio-toggle');
            const iconPlay = document.getElementById('audio-icon-play');
            const iconPause = document.getElementById('audio-icon-pause');
            const muteBtn = document.getElementById('audio-mute');
            const iconVolume = document.getElementById('audio-icon-volume');
            const iconMuted = document.getElementById('audio-icon-muted');
            const progressTrack = document.getElementById('audio-progress-track');
            const progressFill = document.getElementById('audio-progress-fill');
            const progressHandle = document.getElementById('audio-progress-handle');
            const currentTimeEl = document.getElementById('audio-current-time');
            const durationEl = document.getElementById('audio-duration');

            function formatTime(seconds) {
                if (!isFinite(seconds) || isNaN(seconds)) return '0:00';
                const m = Math.floor(seconds / 60);
                const s = Math.floor(seconds % 60).toString().padStart(2, '0');
                return `${m}:${s}`;
            }

            function setPlayingUI(isPlaying) {
                iconPlay.classList.toggle('hidden', isPlaying);
                iconPause.classList.toggle('hidden', !isPlaying);
                toggleBtn.setAttribute('aria-label', isPlaying ? 'Pause' : 'Play');
            }

            function updateProgress() {
                const pct = player.duration ? (player.currentTime / player.duration) * 100 : 0;
                progressFill.style.width = pct + '%';
                progressHandle.style.left = pct + '%';
                currentTimeEl.textContent = formatTime(player.currentTime);
            }

            function seekToClientX(clientX) {
                const rect = progressTrack.getBoundingClientRect();
                const ratio = Math.min(1, Math.max(0, (clientX - rect.left) / rect.width));
                if (isFinite(player.duration)) {
                    player.currentTime = ratio * player.duration;
                    updateProgress();
                }
            }

            toggleBtn.addEventListener('click', function () {
                if (player.paused) {
                    player.play();
                } else {
                    player.pause();
                }
            });

            player.addEventListener('play', () => setPlayingUI(true));
            player.addEventListener('pause', () => setPlayingUI(false));
            player.addEventListener('ended', () => setPlayingUI(false));
            player.addEventListener('timeupdate', updateProgress);
            player.addEventListener('loadedmetadata', function () {
                durationEl.textContent = formatTime(player.duration);
                updateProgress();
            });

            let isDragging = false;
            progressTrack.addEventListener('pointerdown', function (e) {
                isDragging = true;
                seekToClientX(e.clientX);
            });
            window.addEventListener('pointermove', function (e) {
                if (isDragging) seekToClientX(e.clientX);
            });
            window.addEventListener('pointerup', () => {
                isDragging = false;
            });

            muteBtn.addEventListener('click', function () {
                player.muted = !player.muted;
                iconVolume.classList.toggle('hidden', player.muted);
                iconMuted.classList.toggle('hidden', !player.muted);
            });

            select?.addEventListener('change', function () {
                const wasPlaying = !player.paused;
                source.src = this.value;
                player.load();
                updateProgress();
                durationEl.textContent = '0:00';
                if (wasPlaying) {
                    player.play();
                }
            });
        })();
    </script>
@endsection
