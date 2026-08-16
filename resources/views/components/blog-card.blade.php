@php
    $excerpt = Str::limit(strip_tags($blog->content), 110);
@endphp

<article class="group flex flex-col rounded-theme border border-theme-line bg-theme-surface overflow-hidden hover:border-theme-primary/50 transition-colors">
    <a href="{{ route('blog.show', $blog->slug) }}" class="block aspect-[16/10] overflow-hidden bg-theme-surface-raised">
        <img
            src="{{ $blog->thumbnail ? url('storage/'.$blog->thumbnail) : asset('images/thumbnail.jpg') }}"
            alt="{{ $blog->title }}"
            loading="lazy"
            class="h-full w-full object-cover group-hover:scale-105 transition-transform duration-300">
    </a>

    <div class="flex flex-1 flex-col p-5">
        <h3 class="text-base font-bold text-theme-ink leading-snug">
            <a href="{{ route('blog.show', $blog->slug) }}" class="hover:text-theme-primary transition-colors">
                {{ Str::limit($blog->title, 60) }}
            </a>
        </h3>

        <p class="mt-2 text-sm text-theme-muted leading-relaxed flex-1">{{ $excerpt }}</p>

        <div class="mt-4 flex items-center justify-between">
            <time class="text-xs text-theme-muted">{{ $blog->created_at->format('M j, Y') }}</time>

            <a href="{{ route('blog.show', $blog->slug) }}"
               class="inline-flex items-center gap-1.5 rounded-full bg-theme-primary px-4 py-2 text-xs font-bold text-white hover:bg-theme-primary-dark transition-colors">
                Read more
                <svg class="size-3.5" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M3 10a.75.75 0 01.75-.75h10.638L10.23 5.29a.75.75 0 111.04-1.08l5.5 5.25a.75.75 0 010 1.08l-5.5 5.25a.75.75 0 11-1.04-1.08l4.158-3.96H3.75A.75.75 0 013 10z" clip-rule="evenodd" />
                </svg>
            </a>
        </div>
    </div>
</article>
