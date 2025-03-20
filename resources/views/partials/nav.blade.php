<nav class="bg-gray-50 dark:bg-gray-800 fixed top-0 left-0 w-full z-50 shadow-md">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16 items-center">
            <!-- Logo -->
            <div class="flex items-center">
                <a href="#" class="text-2xl font-bold text-blue-600">MyBlog</a>
            </div>

            <!-- Search Bar -->
            <div class="relative w-1/3">
                <input type="text" placeholder="Search..."
                       class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <!-- Navigation Links -->
            <div class="hidden md:flex items-center space-x-6">
                <a href="#" class="text-gray-300 hover:text-blue-500">Home</a>

                <!-- Dropdown 1 -->
                <div class="relative group">
                    <button class="text-gray-300 hover:text-blue-500 focus:outline-none">Categories</button>
                    <div class="absolute left-0 hidden group-hover:flex flex-col bg-white shadow-lg rounded-md w-40">
                        @foreach(\App\Models\Category::where('status', \App\Enums\Status::Active)->get() as $category)
                            <a href="#" class="block px-4 py-2 hover:bg-gray-200 rounded-md">{{ $category->name }}</a>
                        @endforeach
                    </div>
                </div>

                <a href="#" class="text-gray-300 hover:text-blue-500">About</a>

                @guest()
                    <a href="{{ route('filament.admin.auth.login') }}"
                       class="text-gray-300 hover:text-blue-500">Sign in</a>
                @endguest

                @auth()
                    <div class="relative group">
                        <button
                            class="text-gray-300 hover:text-blue-500 focus:outline-none">{{ auth()->user()->name }}</button>
                        <div
                            class="absolute hidden group-hover:flex flex-col bg-white shadow-lg rounded-md w-44 border border-gray-200">
                            <a href="#"
                               class="block px-4 py-3 text-gray-700 hover:bg-gray-200 rounded-t-md transition">My Profile</a>

                            <form method="POST" action="{{ route('filament.admin.auth.logout') }}" class="w-full">
                                @csrf
                                <button type="submit"
                                        class="block w-full text-left px-4 py-3 text-red-600 hover:bg-gray-200 rounded-b-md transition">
                                    Logout
                                </button>
                            </form>
                        </div>

                    </div>
                @endauth
            </div>
        </div>
    </div>
</nav>
