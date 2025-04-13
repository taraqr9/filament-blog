{{--<link rel="stylesheet" href="{{ asset('css/all.min.css') }}">--}}
@if (app()->environment('local'))
    {{-- Local environment: Use Vite --}}
    @vite('resources/css/app.css')
@else
    {{-- Production: Use precompiled assets --}}
    <link rel="stylesheet" href="{{ asset('build/assets/app-DpObo_gX.css') }}">
    <script type="module" src="{{ asset('build/assets/app-D03Ay3w-.js') }}"></script>
@endif

