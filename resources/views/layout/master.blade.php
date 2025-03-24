<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="{{ asset('images/home.jpg') }}">
    <title> {{isset($page_title)? $page_title : 'Blog'}} </title>
    <link rel="icon" type="image/png" href="{{ asset('images/ico.ico') }}"/>

    @include('partials.styles')

    <style>
        @yield('CSSheet')
    </style>

</head>

<body class="hold-transition sidebar-mini layout-navbar-fixed layout-fixed">
<div class="wrapper min-h-screen flex flex-col">
    @include('partials.nav')

    <main class="flex-1">
        @yield('content')
    </main>

    @include('partials.footer')
</div>
@include('partials.scripts')

@yield('JScript')

</body>
</html>
