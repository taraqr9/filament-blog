@extends('layout.master')

@section('content')
    <main class="pt-8 pb-16 lg:pt-16 lg:pb-24 bg-white dark:bg-gray-900 antialiased">
        <div class="flex justify-between px-4 mx-auto max-w-screen-xl ">
            <article
                class="mx-auto w-full max-w-2xl format format-sm sm:format-base lg:format-lg format-blue dark:format-invert">
                <header class="mb-4 lg:mb-6 not-format">
                    <address class="flex items-center mb-6 not-italic">
                        <div class="inline-flex items-center mr-3 text-sm text-gray-900 dark:text-white">
                            <img class="mr-4 w-16 h-16 rounded-full"
                                 src="https://flowbite.com/docs/images/people/profile-picture-2.jpg" alt="Jese Leos">
                            <div>
                                <a href="#" rel="author"
                                   class="text-xl font-bold text-gray-900 dark:text-white">Jese Leos</a>
                                <p class="text-base text-gray-500 dark:text-gray-400">Graphic Designer, educator & CEO Flowbite</p>
                                <p class="text-base text-gray-500 dark:text-gray-400">
                                    <time pubdate datetime="2022-02-08" title="February 8th, 2022">Feb. 8, 2022</time>
                                </p>
                            </div>
                        </div>
                    </address>
                    <h1 class="mb-4 text-3xl font-extrabold leading-tight text-gray-900 lg:mb-6 lg:text-4xl dark:text-white">Best practices for successful prototypes</h1>
                </header>

                <div class="text-gray-900 dark:text-white">
                    The Art of Slow Living: Finding Peace in a Fast-Paced World
                    In today’s world, everything moves at lightning speed. From instant messages to same-day deliveries, we’re constantly rushing from one task to another. But amidst this chaos, there’s a growing movement urging people to slow down and embrace the beauty of slow living.

                    Slow living is about being intentional with your time, focusing on the present, and appreciating the simple joys of life. It’s sipping your morning coffee without checking emails, taking a walk without headphones, or having a long conversation without glancing at your phone. It’s about quality over quantity—less stress, more fulfillment.

                    Research suggests that slowing down can lead to improved mental health, better relationships, and a deeper sense of happiness. By prioritizing mindfulness and balance, we allow ourselves to breathe, reflect, and truly live.

                    So, how can you practice slow living? Start by setting boundaries with technology, spending more time in nature, and embracing a routine that prioritizes well-being. Remember, life isn’t a race—it’s a journey to be savored.

                    What small step will you take today to slow down? 🚶‍♂️☕
                </div>

            </article>
        </div>
    </main>

    <hr class="border-gray-200 sm:mx-auto dark:border-gray-700">
@endsection
