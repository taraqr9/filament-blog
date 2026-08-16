@if (app('impersonate')->isImpersonating())
    <div class="w-full flex items-center justify-center gap-4 py-2 px-4 text-sm text-white" style="background-color:#18181b;">
        <span>You are viewing the site as <strong>{{ auth()->user()?->name }}</strong>.</span>
        <a href="{{ route('filament-impersonate.leave') }}" class="underline font-semibold hover:text-amber-400">
            Leave impersonation
        </a>
    </div>
@endif
