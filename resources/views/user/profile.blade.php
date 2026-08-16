@extends('layout.master')

@section('content')
    <section class="flex items-center justify-center min-h-screen bg-gray-600 py-12">
        <div class="max-w-2xl w-full bg-gray-50 p-8 rounded-lg shadow-lg flex flex-col items-center justify-center">
            <h2 class="text-2xl font-bold mb-6 text-center text-gray-800">Profile</h2>

            <form action="{{ route('profile.update', $user) }}" method="POST" class="w-full">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label class="block text-gray-700 font-semibold mb-2">Name</label>
                    <input type="text" name="name" value="{{ $user->name }}"
                           class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500">
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 font-semibold mb-2">Email</label>
                    <input type="email" name="email" value="{{ $user->email }}"
                           class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500">
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 font-semibold mb-2">Phone</label>
                    <input type="text" name="phone" value="{{ $user->phone }}"
                           class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500">
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 font-semibold mb-2">New Password</label>
                    <input type="password" name="password"
                           class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500">
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 font-semibold mb-2">Confirm Password</label>
                    <input type="password" name="password_confirmation"
                           class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500">
                </div>

                <button type="submit"
                        class="w-full bg-blue-600 text-white py-2 rounded-lg shadow-md hover:bg-blue-700 transition">
                    Update Profile
                </button>
            </form>
        </div>
    </section>
@endsection
