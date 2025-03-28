<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Server Error</title>
    @vite('resources/css/app.css')
</head>
<body class="flex items-center justify-center h-screen bg-gray-100">

<div class="text-center">
    <h1 class="text-6xl font-extrabold text-red-600">500</h1>
    <h2 class="text-3xl font-bold text-gray-800 mt-4">Internal Server Error</h2>
    <p class="text-gray-600 mt-2">Something went wrong on our end. Please try again later.</p>

    <a href="{{ route('home') }}"
       class="mt-6 inline-block bg-blue-600 text-white px-6 py-3 rounded-lg shadow-md hover:bg-blue-700 transition">
        Go Back Home
    </a>
</div>

</body>
</html>
