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
                <a href="#" class="text-gray-300 hover:text-blue-500">About</a>

                <!-- Dropdown 1 -->
                <div class="relative group">
                    <button class="text-gray-300 hover:text-blue-500 focus:outline-none">Categories</button>
                    <div class="absolute left-0 hidden group-hover:flex flex-col bg-white shadow-lg rounded-md w-40">
                        <a href="#" class="block px-4 py-2 hover:bg-gray-200 rounded-md">Technology</a>
                        <a href="#" class="block px-4 py-2 hover:bg-gray-200 rounded-md">Health</a>
                        <a href="#" class="block px-4 py-2 hover:bg-gray-200 rounded-md">Lifestyle</a>
                    </div>
                </div>

                <!-- Dropdown 2 -->
                <div class="relative group">
                    <button class="text-gray-300 hover:text-blue-500 focus:outline-none">More</button>
                    <div class="absolute left-0 hidden group-hover:flex flex-col bg-white shadow-lg rounded-md w-40">
                        <a href="#" class="block px-4 py-2 hover:bg-gray-200 rounded-md">Contact</a>
                        <a href="#" class="block px-4 py-2 hover:bg-gray-200 rounded-md">Privacy Policy</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</nav>
