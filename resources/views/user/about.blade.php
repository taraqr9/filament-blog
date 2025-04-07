@php($hideSubscription = true)
@extends('layout.master')

@section('content')
    <main class="pt-8 pb-16 lg:pt-16 lg:pb-24 bg-white dark:bg-gray-900 antialiased min-h-screen">
        <div class="flex justify-center px-4 mx-auto max-w-screen-xl">
            <article class="mx-auto w-full max-w-2xl">
                <div>
                    <div class="mr-10 mt-10">
                        <img class="rounded-lg w-full md:w-auto h-auto"
                             src="{{ asset('images/about.jpg') }}"
                             alt="Profile Image">
                    </div>
                    <div class="w-full">
                        <h1 class="text-gray-900 dark:text-white font-bold text-3xl mt-6 mb-8">
                            Hey, I'm Kazi Akramul Haque
                        </h1>
                        <p class="text-gray-700 dark:text-gray-300 mb-4">
                            An experienced IT professional currently serving as the Chief Services Officer (CSO) at BOL. With a strong background in IT-enabled services, infrastructure management, and software development, I have led multiple teams, ensuring efficient service delivery and technological innovation.
                        </p>
                        <p class="text-gray-700 dark:text-gray-300 mb-4">
                            Over the years, I have successfully managed technical departments, restructured customer service teams, optimized network infrastructure, and developed IT governance policies. My expertise spans network engineering, data infrastructure, and skill development.
                        </p>
                        <p class="text-gray-700 dark:text-gray-300 mb-10">
                            Passionate about innovation, technology, and leadership, I continuously strive to enhance IT solutions and improve business operations. Let's connect and collaborate on transformative tech initiatives!
                        </p>

                        <div class="flex flex-wrap gap-4 flex justify-between">
                            <a rel="noopener" target="_blank" href="https://www.linkedin.com/in/tasinkazi"
                               class="bg-gray-800 hover:bg-gray-700 transition-all rounded-lg p-4 w-48 flex items-center gap-3 text-white shadow-lg">
                                <img class="w-6 h-6" src="{{ asset('images/icons/linkedin.png') }}" alt="LinkedIn" />
                                <span class="text-lg font-medium">LinkedIn</span>
                            </a>
                            <a rel="noopener" target="_blank" href="mailto:tasinkazi@gmail.com"
                               class="bg-gray-800 hover:bg-gray-700 transition-all rounded-lg p-4 w-48 flex items-center gap-3 text-white shadow-lg">
                                <img class="w-6 h-6" src="{{ asset('images/icons/mail.png') }}" alt="Email" />
                                <span class="text-lg font-medium">Email Me</span>
                            </a>
                            <div x-data="{ showNumber: false }"
                                 class="bg-gray-800 hover:bg-gray-700 transition-all rounded-lg p-4 w-56 flex items-center gap-3 text-white shadow-lg cursor-pointer"
                                 @click="showNumber = !showNumber">
                                <img class="w-6 h-6" src="{{ asset('images/icons/telephone.png') }}" alt="Phone" />
                                <span class="text-lg font-medium" x-text="showNumber ? '+88001976672358' : 'Call Me'"></span>
                            </div>
                        </div>

                    </div>
                </div>
            </article>
        </div>
    </main>
@endsection

@section('JScript')
    <script src="{{ asset('js/alpinejs-3.13.3.js') }}"></script>
@endsection


