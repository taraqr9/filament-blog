<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{{ $title ?? 'Preview' }}</title>
    @vite('resources/css/app.css')
    @livewireStyles
</head>
<body class="bg-white dark:bg-gray-900 text-gray-800 dark:text-gray-100 antialiased">
{{ $slot }}
@livewireScripts
</body>
</html>
