@props(['images' => []])

@php
    $slides = collect($images)->filter()->values();

    if ($slides->isEmpty()) {
        $slides = collect([
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
        ])->map(fn ($image) => asset($image));
    }
@endphp

<div {{ $attributes->merge(['class' => 'relative h-[60vh] min-h-[420px] overflow-hidden rounded-theme shadow-theme-lg']) }}>
    @foreach ($slides as $index => $image)
        <img src="{{ $image }}" alt="Hero image"
             style="opacity: {{ $index === 0 ? 1 : 0 }}; transform: scale({{ $index === 0 ? 1.08 : 1 }});"
             class="hero-slide absolute inset-0 h-full w-full object-cover will-change-transform transition-[opacity,transform] duration-[1200ms,6000ms] ease-out">
    @endforeach

    <div class="absolute inset-0 bg-gradient-to-t from-black/50 via-transparent to-transparent"></div>

    <div class="absolute bottom-7 inset-x-0 flex items-center justify-center gap-2">
        @foreach ($slides as $index => $image)
            <span class="hero-dot h-1.5 rounded-full transition-all duration-500 {{ $index === 0 ? 'w-8 bg-white' : 'w-1.5 bg-white/40' }}"></span>
        @endforeach
    </div>
</div>

<script>
    (function () {
        const container = document.currentScript.previousElementSibling;
        const slides = container.querySelectorAll('.hero-slide');
        const dots = container.querySelectorAll('.hero-dot');
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
