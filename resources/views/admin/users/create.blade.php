@extends('layouts.admin')

@section('admin-content')
<div class="max-w-3xl">
    <!-- Header -->
    <div class="mb-8">
        <div class="flex items-center space-x-4 mb-4">
            <a href="{{ route('admin.users.index') }}" class="p-2 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg transition-colors">
                <svg class="w-5 h-5 text-gray-600 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
            </a>
            <div>
                <h1 class="text-3xl font-bold text-gray-900 dark:text-gray-100">Create New User</h1>
                <p class="text-gray-600 dark:text-gray-300">Add a new user to the system</p>
            </div>
        </div>
    </div>

    <!-- Form Card -->
    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg border border-gray-200 dark:border-gray-700 overflow-hidden">
        <form action="{{ route('admin.users.store') }}" method="POST" class="p-8 space-y-6">
            @csrf

            <!-- Name -->
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                    Full Name <span class="text-red-500">*</span>
                </label>
                <input type="text" name="name" id="name" value="{{ old('name') }}" required
                    class="w-full px-4 py-3 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-brand-500 focus:border-transparent transition-colors @error('name') border-red-500 @enderror">
                @error('name')
                    <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                @enderror
            </div>

            <!-- Email -->
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                    Email Address <span class="text-red-500">*</span>
                </label>
                <input type="email" name="email" id="email" value="{{ old('email') }}" required
                    class="w-full px-4 py-3 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-brand-500 focus:border-transparent transition-colors @error('email') border-red-500 @enderror">
                @error('email')
                    <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                @enderror
            </div>

            <!-- Password -->
            <div>
                <label for="password" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                    Password <span class="text-red-500">*</span>
                </label>
                <input type="password" name="password" id="password" required
                    class="w-full px-4 py-3 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-brand-500 focus:border-transparent transition-colors @error('password') border-red-500 @enderror">
                @error('password')
                    <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                @enderror
                <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">Minimum 8 characters</p>
            </div>

            <!-- Password Confirmation -->
            <div>
                <label for="password_confirmation" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                    Confirm Password <span class="text-red-500">*</span>
                </label>
                <input type="password" name="password_confirmation" id="password_confirmation" required
                    class="w-full px-4 py-3 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-brand-500 focus:border-transparent transition-colors">
            </div>

            <!-- Role -->
            <div>
                <label for="role" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                    User Role <span class="text-red-500">*</span>
                </label>
                <select name="role" id="role" required
                    class="w-full px-4 py-3 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-brand-500 focus:border-transparent transition-colors @error('role') border-red-500 @enderror">
                    <option value="user" {{ old('role') === 'user' ? 'selected' : '' }}>User</option>
                    <option value="author" {{ old('role') === 'author' ? 'selected' : '' }}>Author</option>
                    <option value="admin" {{ old('role') === 'admin' ? 'selected' : '' }}>Administrator</option>
                </select>
                @error('role')
                    <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                @enderror
                <div class="mt-3 space-y-2 text-sm text-gray-600 dark:text-gray-400">
                    <p><strong class="text-gray-900 dark:text-gray-200">User:</strong> Can view content</p>
                    <p><strong class="text-gray-900 dark:text-gray-200">Author:</strong> Can create and manage own posts</p>
                    <p><strong class="text-gray-900 dark:text-gray-200">Administrator:</strong> Full system access</p>
                </div>
            </div>

            <!-- Actions -->
            <div class="flex items-center justify-end space-x-4 pt-6 border-t border-gray-200 dark:border-gray-700">
                <a href="{{ route('admin.users.index') }}" class="px-6 py-3 text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg font-medium transition-colors">
                    Cancel
                </a>
                <button type="submit" class="px-6 py-3 bg-gradient-to-r from-brand-600 to-accent-600 hover:from-brand-700 hover:to-accent-700 text-white rounded-lg font-medium transition-all hover:scale-105 shadow-lg">
                    Create User
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

