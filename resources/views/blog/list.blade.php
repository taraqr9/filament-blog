@extends('layout.master')

@section('content')
    <section class="pt-24 pb-16 bg-gray-600 min-h-screen">
        <div class="max-w-7xl mx-auto px-4">
            <h2 class="text-3xl font-bold text-white text-center mb-8">Latest Blog Posts</h2>

            <!-- Blog Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- Blog Card 1 -->
                <div class="bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition">
                    <img src="/images/blog1.jpg" alt="Blog Image" class="rounded-md mb-4">
                    <h3 class="text-lg font-semibold">Best Practices for Prototyping</h3>
                    <p class="text-gray-600">Learn how to create effective design prototypes.</p>
                    <a href="#" class="text-blue-600 hover:underline mt-2 block">Read more</a>
                </div>

                <!-- Blog Card 2 -->
                <div class="bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition">
                    <img src="/images/blog2.jpg" alt="Blog Image" class="rounded-md mb-4">
                    <h3 class="text-lg font-semibold">The Art of Slow Living</h3>
                    <p class="text-gray-600">Discover how to embrace mindfulness in a fast-paced world.</p>
                    <a href="#" class="text-blue-600 hover:underline mt-2 block">Read more</a>
                </div>

                <!-- Blog Card 3 -->
                <div class="bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition">
                    <img src="/images/blog3.jpg" alt="Blog Image" class="rounded-md mb-4">
                    <h3 class="text-lg font-semibold">Tech Innovations in 2025</h3>
                    <p class="text-gray-600">Explore the latest breakthroughs in technology.</p>
                    <a href="#" class="text-blue-600 hover:underline mt-2 block">Read more</a>
                </div>

                <!-- Blog Card 4 -->
                <div class="bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition">
                    <img src="/images/blog4.jpg" alt="Blog Image" class="rounded-md mb-4">
                    <h3 class="text-lg font-semibold">Productivity Hacks for Developers</h3>
                    <p class="text-gray-600">Increase efficiency with these proven techniques.</p>
                    <a href="#" class="text-blue-600 hover:underline mt-2 block">Read more</a>
                </div>

                <!-- Blog Card 5 -->
                <div class="bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition">
                    <img src="/images/blog5.jpg" alt="Blog Image" class="rounded-md mb-4">
                    <h3 class="text-lg font-semibold">Balancing Work & Life as a Freelancer</h3>
                    <p class="text-gray-600">Tips on maintaining a healthy work-life balance.</p>
                    <a href="#" class="text-blue-600 hover:underline mt-2 block">Read more</a>
                </div>

                <!-- Blog Card 6 -->
                <div class="bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition">
                    <img src="/images/blog6.jpg" alt="Blog Image" class="rounded-md mb-4">
                    <h3 class="text-lg font-semibold">Introduction to AI & Machine Learning</h3>
                    <p class="text-gray-600">Understand the basics of artificial intelligence.</p>
                    <a href="#" class="text-blue-600 hover:underline mt-2 block">Read more</a>
                </div>
            </div>

            <!-- Pagination -->
            <div class="mt-10 flex justify-center">
                <a href="#" class="px-4 py-2 bg-blue-600 text-white rounded-md mx-1 hover:bg-blue-500">1</a>
                <a href="#" class="px-4 py-2 bg-gray-500 text-white rounded-md mx-1 hover:bg-gray-400">2</a>
                <a href="#" class="px-4 py-2 bg-gray-500 text-white rounded-md mx-1 hover:bg-gray-400">3</a>
                <span class="px-4 py-2 bg-gray-300 text-gray-700 rounded-md mx-1">...</span>
                <a href="#" class="px-4 py-2 bg-gray-500 text-white rounded-md mx-1 hover:bg-gray-400">Next</a>
            </div>
        </div>
    </section>
@endsection
