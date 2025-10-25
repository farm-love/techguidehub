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
                <h1 class="text-3xl font-bold text-gray-900 dark:text-gray-100">Edit User</h1>
                <p class="text-gray-600 dark:text-gray-300">Update user information</p>
            </div>
        </div>
    </div>

    <!-- Form Card -->
    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg border border-gray-200 dark:border-gray-700 overflow-hidden">
        <form action="{{ route('admin.users.update', $user) }}" method="POST" class="p-8 space-y-6">
            @csrf
            @method('PUT')

            <!-- Name -->
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                    Full Name <span class="text-red-500">*</span>
                </label>
                <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" required
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
                <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" required
                    class="w-full px-4 py-3 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-brand-500 focus:border-transparent transition-colors @error('email') border-red-500 @enderror">
                @error('email')
                    <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                @enderror
            </div>

            <!-- Password -->
            <div>
                <label for="password" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                    New Password
                </label>
                <input type="password" name="password" id="password"
                    class="w-full px-4 py-3 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-brand-500 focus:border-transparent transition-colors @error('password') border-red-500 @enderror">
                @error('password')
                    <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                @enderror
                <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">Leave blank to keep current password. Minimum 8 characters if changing.</p>
            </div>

            <!-- Password Confirmation -->
            <div>
                <label for="password_confirmation" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                    Confirm New Password
                </label>
                <input type="password" name="password_confirmation" id="password_confirmation"
                    class="w-full px-4 py-3 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-brand-500 focus:border-transparent transition-colors">
            </div>

            <!-- Role -->
            <div>
                <label for="role" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                    User Role <span class="text-red-500">*</span>
                </label>
                <select name="role" id="role" required
                    class="w-full px-4 py-3 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-brand-500 focus:border-transparent transition-colors @error('role') border-red-500 @enderror"
                    {{ $user->id === auth()->id() ? 'disabled' : '' }}>
                    <option value="user" {{ old('role', $user->role) === 'user' ? 'selected' : '' }}>User</option>
                    <option value="author" {{ old('role', $user->role) === 'author' ? 'selected' : '' }}>Author</option>
                    <option value="admin" {{ old('role', $user->role) === 'admin' ? 'selected' : '' }}>Administrator</option>
                </select>
                @if($user->id === auth()->id())
                    <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">You cannot change your own role.</p>
                    <input type="hidden" name="role" value="{{ $user->role }}">
                @endif
                @error('role')
                    <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                @enderror
            </div>

            <!-- User Info -->
            <div class="bg-gray-50 dark:bg-gray-700/50 rounded-lg p-4 space-y-2 text-sm">
                <div class="flex justify-between">
                    <span class="text-gray-600 dark:text-gray-400">User ID:</span>
                    <span class="font-medium text-gray-900 dark:text-gray-100">{{ $user->id }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-600 dark:text-gray-400">Created:</span>
                    <span class="font-medium text-gray-900 dark:text-gray-100">{{ $user->created_at->format('M d, Y') }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-600 dark:text-gray-400">Posts:</span>
                    <span class="font-medium text-gray-900 dark:text-gray-100">{{ $user->posts()->count() }}</span>
                </div>
            </div>

            <!-- Actions -->
            <div class="flex items-center justify-end space-x-4 pt-6 border-t border-gray-200 dark:border-gray-700">
                <a href="{{ route('admin.users.index') }}" class="px-6 py-3 text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg font-medium transition-colors">
                    Cancel
                </a>
                <button type="submit" class="px-6 py-3 bg-gradient-to-r from-brand-600 to-accent-600 hover:from-brand-700 hover:to-accent-700 text-white rounded-lg font-medium transition-all hover:scale-105 shadow-lg">
                    Update User
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

