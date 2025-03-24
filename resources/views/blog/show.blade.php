@php use App\Helper\Common; @endphp
@extends('layout.master')

@section('CSSheet')
    figure figcaption {
    display: none;
    }
@endsection

@section('content')
    <main class="pt-8 pb-16 lg:pt-16 lg:pb-24 bg-white dark:bg-gray-900 antialiased min-h-screen">
        <div class="flex justify-between px-4 mx-auto max-w-screen-xl ">
            <article
                class="mx-auto w-full max-w-2xl format format-sm sm:format-base lg:format-lg format-blue dark:format-invert">
                <header class="mb-4 lg:mb-6 not-format">
                    <address class="flex items-center mb-6 not-italic">
                        <div class="inline-flex items-center mr-3 text-sm text-gray-900 dark:text-white">
                            <img class="mr-4 w-16 h-16 rounded-full"
                                 src="{{ $blog->user->avatar ? url('storage/'.$blog->user->avatar) : asset('images/person.png') }}"
                                 alt="Jese Leos">
                            <div>
                                <a href="#" rel="author"
                                   class="text-xl font-bold text-gray-900 dark:text-white">{{ $blog->user->name }}</a>
                                <p class="text-base text-gray-500 dark:text-gray-400">{{ $blog->user->profession }}</p>
                                <p class="text-base text-gray-500 dark:text-gray-400">
                                    <time pubdate datetime="2022-02-08"
                                          title="February 8th, 2022">{{ Common::dateTimeFormat($blog->created_at) }}</time>
                                </p>
                                {{ $blog->category->name }} // Remove this
                            </div>
                        </div>
                    </address>

                    <hr class="border-gray-200 sm:mx-auto dark:border-gray-700">

                    <h1 class="mt-4 mb-4 text-3xl font-extrabold leading-tight text-gray-900 lg:mb-6 lg:text-4xl dark:text-white">{{ $blog->title }}</h1>
                </header>

                <div class="text-gray-900 dark:text-white">
                    {!! $blog->content !!}
                </div>

            </article>
        </div>
    </main>

    <hr class="border-gray-200 sm:mx-auto dark:border-gray-700">
@endsection
