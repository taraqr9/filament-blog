@extends('layout.master')

@section('content')
    <section class="min-h-[calc(100vh-6rem)] flex items-center justify-center px-4 py-16">
        <div class="w-full max-w-md">
            <div class="text-center mb-8">
                <a href="{{ route('home') }}" class="text-theme-ink font-extrabold text-lg tracking-tight">
                    {{ config('app.name') }}
                </a>
                <h1 class="mt-4 text-3xl font-extrabold tracking-tight text-theme-ink">Welcome back</h1>
                <p class="mt-2 text-sm text-theme-muted">Sign in to continue reading and listening.</p>
            </div>

            <div class="rounded-theme border border-theme-line bg-theme-surface shadow-theme-lg p-6 sm:p-8">
                <form action="{{ route('login.attempt') }}" method="POST" class="space-y-5">
                    @csrf

                    <div>
                        <label for="username" class="block text-sm font-semibold text-theme-ink mb-1.5">Username</label>
                        <input type="text" id="username" name="username" value="{{ old('username') }}" required
                               autofocus autocomplete="username"
                               class="w-full rounded-theme-sm border border-theme-line bg-theme-surface-raised px-4 py-2.5 text-sm text-theme-ink placeholder:text-theme-muted focus:outline-none focus:ring-2 focus:ring-theme-primary">
                        @error('username')
                            <p class="mt-1.5 text-sm text-theme-accent">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="password" class="block text-sm font-semibold text-theme-ink mb-1.5">Password</label>
                        <input type="password" id="password" name="password" required
                               autocomplete="current-password"
                               class="w-full rounded-theme-sm border border-theme-line bg-theme-surface-raised px-4 py-2.5 text-sm text-theme-ink placeholder:text-theme-muted focus:outline-none focus:ring-2 focus:ring-theme-primary">
                        @error('password')
                            <p class="mt-1.5 text-sm text-theme-accent">{{ $message }}</p>
                        @enderror
                    </div>

                    <label class="flex items-center gap-2 text-sm text-theme-muted">
                        <input type="checkbox" name="remember"
                               class="rounded border-theme-line bg-theme-surface-raised text-theme-primary focus:ring-theme-primary">
                        Remember me
                    </label>

                    <button type="submit"
                            class="w-full rounded-full bg-theme-primary px-6 py-3 text-sm font-bold text-white hover:bg-theme-primary-dark transition-colors">
                        Sign in
                    </button>
                </form>
            </div>

            <p class="mt-6 text-center text-sm text-theme-muted">
                <a href="{{ route('home') }}" class="font-semibold text-theme-primary hover:text-theme-primary-dark transition-colors">
                    &larr; Back to home
                </a>
            </p>
        </div>
    </section>
@endsection
