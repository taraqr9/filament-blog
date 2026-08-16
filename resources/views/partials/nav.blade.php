<header class="sticky top-0 z-50 py-2.5 px-4">
    <div class="max-w-container mx-auto">
        <div class="flex items-center justify-between gap-4 h-16 px-5 rounded-full border border-white/10 bg-theme-bg/70 backdrop-blur-md backdrop-saturate-150 shadow-theme-header">
            <a href="{{ route('home') }}" class="flex items-center gap-2 text-theme-ink font-extrabold text-lg tracking-tight shrink-0">
                {{ config('app.name') }}
            </a>

            <nav class="hidden md:flex items-center gap-8">
                <a href="{{ route('home') }}"
                   class="text-sm font-medium text-theme-body hover:text-theme-ink transition-colors">Home</a>
                <a href="{{ route('blog.index') }}"
                   class="text-sm font-medium text-theme-body hover:text-theme-ink transition-colors">Blogs</a>
                <a href="{{ route('about') }}"
                   class="text-sm font-medium text-theme-body hover:text-theme-ink transition-colors">About</a>
            </nav>

            <div class="hidden md:flex items-center gap-3 shrink-0">
                @guest()
                    <a href="{{ route('login') }}"
                       class="inline-flex items-center gap-2 rounded-full bg-theme-primary px-[18px] py-[10px] text-sm font-bold text-white hover:bg-theme-primary-dark transition-colors">
                        Sign in
                    </a>
                @endguest

                @auth()
                    <div class="relative group">
                        <button type="button"
                                class="flex items-center gap-2 text-sm font-medium text-theme-body hover:text-theme-ink transition-colors">
                            {{ auth()->user()->name }}
                            <svg class="size-4" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z" clip-rule="evenodd" />
                            </svg>
                        </button>
                        <div class="absolute right-0 hidden group-hover:flex flex-col w-44 rounded-theme-sm border border-theme-line bg-theme-surface shadow-theme overflow-hidden">
                            <a href="{{ route('profile') }}"
                               class="block px-4 py-3 text-sm text-theme-body hover:bg-theme-surface-raised hover:text-theme-ink transition-colors">My
                                Profile</a>

                            <form method="POST" action="{{ route('logout') }}" class="w-full">
                                @csrf
                                <button type="submit"
                                        class="block w-full text-left px-4 py-3 text-sm text-theme-accent hover:bg-theme-surface-raised transition-colors">
                                    Logout
                                </button>
                            </form>
                        </div>
                    </div>
                @endauth
            </div>

            <button type="button" id="mobile-menu-button" aria-label="Toggle menu"
                    class="md:hidden inline-flex items-center justify-center size-10 rounded-full text-theme-ink hover:bg-white/5 transition-colors">
                <svg id="mobile-menu-icon-open" class="size-6" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5M3.75 17.25h16.5" />
                </svg>
                <svg id="mobile-menu-icon-close" class="size-6 hidden" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <div id="mobile-menu" class="hidden md:hidden mt-2 rounded-theme border border-theme-line bg-theme-surface shadow-theme-lg overflow-hidden">
            <nav class="flex flex-col divide-y divide-theme-line">
                <a href="{{ route('home') }}" class="px-5 py-3.5 text-sm font-medium text-theme-body hover:text-theme-ink">Home</a>
                <a href="{{ route('blog.index') }}" class="px-5 py-3.5 text-sm font-medium text-theme-body hover:text-theme-ink">Blogs</a>
                <a href="{{ route('about') }}" class="px-5 py-3.5 text-sm font-medium text-theme-body hover:text-theme-ink">About</a>

                @guest()
                    <a href="{{ route('login') }}"
                       class="px-5 py-3.5 text-sm font-bold text-theme-primary">Sign in</a>
                @endguest

                @auth()
                    <a href="{{ route('profile') }}" class="px-5 py-3.5 text-sm font-medium text-theme-body hover:text-theme-ink">My
                        Profile</a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="w-full text-left px-5 py-3.5 text-sm font-medium text-theme-accent">
                            Logout
                        </button>
                    </form>
                @endauth
            </nav>
        </div>
    </div>
</header>

<script>
    (function () {
        const button = document.getElementById('mobile-menu-button');
        const menu = document.getElementById('mobile-menu');
        const iconOpen = document.getElementById('mobile-menu-icon-open');
        const iconClose = document.getElementById('mobile-menu-icon-close');

        button?.addEventListener('click', function () {
            menu.classList.toggle('hidden');
            iconOpen.classList.toggle('hidden');
            iconClose.classList.toggle('hidden');
        });
    })();
</script>
