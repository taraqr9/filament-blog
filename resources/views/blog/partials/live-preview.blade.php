<main class="pt-8 pb-16 lg:pt-16 lg:pb-24 bg-white dark:bg-gray-900 antialiased min-h-screen">
    <div class="flex justify-between px-4 mx-auto max-w-screen-xl">
        <article
            class="mx-auto w-full max-w-2xl format format-sm sm:format-base lg:format-lg format-blue dark:format-invert">
            <header class="mb-4 lg:mb-6 not-format">
                <address class="flex items-center mb-6 not-italic">
                    <div class="inline-flex items-center mr-3 text-sm text-gray-900 dark:text-white">
                        <img class="mr-4 w-16 h-16 rounded-full"
                             src="{{ $userAvatar }}"
                             alt="Author">
                        <div>
                            <a href="#" class="text-xl font-bold text-gray-900 dark:text-white">{{ $userName }}</a>
                            <p class="text-base text-gray-500 dark:text-gray-400">{{ $userProfession }}</p>
                            <p class="text-base text-gray-500 dark:text-gray-400">
                                <time>{{ $createdAt }}</time>
                            </p>
                        </div>
                    </div>
                </address>

                <hr class="border-gray-200 sm:mx-auto dark:border-gray-700 mb-4">

                <img src="https://placehold.co/600x300?text=Thumnail+will+show+here." alt="Thumbnail"
                     class="h-80 w-full object-contain rounded-xl mb-4 mx-auto"/>

                @if($title != 'null')
                    <h1 class="mb-4 text-3xl font-extrabold leading-tight text-gray-900 lg:mb-6 lg:text-4xl dark:text-white w-full">
                        {{ $title }}
                    </h1>
                @endif
            </header>

            @if($content != 'null')
                <div class="text-gray-900 dark:text-white prose dark:prose-invert max-w-none">
                    {!! $content !!}
                </div>
            @endif
        </article>
    </div>
</main>
