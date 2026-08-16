<footer class="bg-theme-footer-bg border-t border-theme-line mt-16">
    <div class="max-w-container mx-auto px-4 py-12">
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-8">
            <div>
                <a href="{{ route('home') }}" class="text-lg font-extrabold text-white">{{ config('app.name') }}</a>
                <p class="mt-3 text-sm text-theme-muted max-w-xs">
                    Stories, guides, and audio narration to help you explore places from anywhere.
                </p>
            </div>

            <div>
                <h3 class="text-sm font-semibold text-white uppercase tracking-wide">Navigate</h3>
                <ul class="mt-4 space-y-2.5">
                    <li><a href="{{ route('home') }}" class="text-sm text-theme-muted hover:text-white transition-colors">Home</a></li>
                    <li><a href="{{ route('blog.index') }}" class="text-sm text-theme-muted hover:text-white transition-colors">Blogs</a></li>
                    <li><a href="{{ route('about') }}" class="text-sm text-theme-muted hover:text-white transition-colors">About</a></li>
                </ul>
            </div>

            <div>
                <h3 class="text-sm font-semibold text-white uppercase tracking-wide">Account</h3>
                <ul class="mt-4 space-y-2.5">
                    @guest()
                        <li><a href="{{ route('filament.admin.auth.login') }}"
                               class="text-sm text-theme-muted hover:text-white transition-colors">Sign in</a></li>
                    @endguest
                    @auth()
                        <li><a href="{{ route('profile') }}"
                               class="text-sm text-theme-muted hover:text-white transition-colors">My Profile</a></li>
                    @endauth
                </ul>
            </div>
        </div>

        <div class="mt-10 pt-6 border-t border-theme-line text-center text-sm text-theme-muted">
            <p>&copy; {{ date('Y') }} <span class="font-semibold text-white">{{ config('app.name') }}</span>. All
                rights reserved.</p>
        </div>
    </div>
</footer>
