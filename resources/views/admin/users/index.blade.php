@extends('layouts.admin')

@section('admin-content')
<div class="space-y-6">
    <!-- Header -->
    <div class="flex justify-between items-center">
        <div>
            <h1 class="text-3xl font-bold text-gray-900 dark:text-gray-100">Users</h1>
            <p class="text-gray-600 dark:text-gray-300">Manage user accounts and permissions</p>
        </div>
        <a href="{{ route('admin.users.create') }}" class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-brand-600 to-accent-600 text-white text-sm font-medium rounded-lg hover:from-brand-700 hover:to-accent-700 focus:outline-none focus:ring-2 focus:ring-brand-500 focus:ring-offset-2 transition-all hover:scale-105">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
            </svg>
            Add User
        </a>
    </div>

    <!-- Success/Error Messages -->
    @if(session('success'))
    <div class="bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-700 rounded-xl p-4">
        <div class="flex items-center">
            <svg class="h-5 w-5 text-green-400" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
            </svg>
            <p class="ml-3 text-sm font-medium text-green-800 dark:text-green-100">{{ session('success') }}</p>
        </div>
    </div>
    @endif

    @if(session('error'))
    <div class="bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-700 rounded-xl p-4">
        <div class="flex items-center">
            <svg class="h-5 w-5 text-red-400" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
            </svg>
            <p class="ml-3 text-sm font-medium text-red-800 dark:text-red-100">{{ session('error') }}</p>
        </div>
    </div>
    @endif

    <!-- Users Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($users as $user)
        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-md border border-gray-200 dark:border-gray-700 overflow-hidden hover:shadow-xl transition-all duration-300 hover:-translate-y-1">
            <!-- Header with Gradient -->
            <div class="h-24 bg-gradient-to-r from-brand-600 to-accent-600 relative">
                <!-- Role Badge -->
                <span class="absolute top-4 right-4 px-3 py-1 text-xs font-semibold rounded-full
                    @if($user->role === 'admin') bg-purple-500 text-white
                    @elseif($user->role === 'author') bg-blue-500 text-white
                    @else bg-gray-500 text-white
                    @endif">
                    {{ ucfirst($user->role) }}
                </span>
            </div>

            <!-- Content -->
            <div class="p-6 relative">
                <!-- Avatar -->
                <div class="absolute -top-12 left-6">
                    <div class="w-20 h-20 rounded-full border-4 border-white dark:border-gray-800 bg-gradient-to-r from-brand-500 to-accent-500 flex items-center justify-center shadow-lg">
                        <span class="text-2xl font-bold text-white">{{ substr($user->name, 0, 1) }}</span>
                    </div>
                </div>

                <div class="mt-10">
                    <!-- Name & Email -->
                    <h3 class="text-lg font-bold text-gray-900 dark:text-white truncate">{{ $user->name }}</h3>
                    <p class="text-sm text-gray-500 dark:text-gray-400 truncate">{{ $user->email }}</p>

                    <!-- Stats -->
                    <div class="mt-4 grid grid-cols-2 gap-4">
                        <div class="text-center p-3 bg-gray-50 dark:bg-gray-700/50 rounded-lg">
                            <div class="text-2xl font-bold text-brand-600 dark:text-brand-400">{{ $user->posts_count }}</div>
                            <div class="text-xs text-gray-600 dark:text-gray-400">Posts</div>
                        </div>
                        <div class="text-center p-3 bg-gray-50 dark:bg-gray-700/50 rounded-lg">
                            <div class="text-xs text-gray-500 dark:text-gray-400 mb-1">Joined</div>
                            <div class="text-xs font-medium text-gray-900 dark:text-gray-100">{{ $user->created_at->format('M Y') }}</div>
                        </div>
                    </div>

                    <!-- Actions -->
                    <div class="mt-6 flex items-center justify-between space-x-2">
                        <a href="{{ route('admin.users.edit', $user) }}" class="flex-1 text-center px-3 py-2 bg-brand-50 dark:bg-brand-900/20 text-brand-700 dark:text-brand-300 rounded-lg hover:bg-brand-100 dark:hover:bg-brand-900/40 text-sm font-medium transition-colors">
                            Edit
                        </a>
                        @if($user->id !== auth()->id())
                        <form action="{{ route('admin.users.destroy', $user) }}" method="POST" class="flex-1" onsubmit="return confirm('Are you sure you want to delete this user?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="w-full px-3 py-2 bg-red-50 dark:bg-red-900/20 text-red-700 dark:text-red-300 rounded-lg hover:bg-red-100 dark:hover:bg-red-900/40 text-sm font-medium transition-colors">
                                Delete
                            </button>
                        </form>
                        @else
                        <div class="flex-1 text-center px-3 py-2 bg-gray-100 dark:bg-gray-700 text-gray-400 rounded-lg text-sm font-medium cursor-not-allowed">
                            You
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        @empty
        <div class="col-span-full text-center py-16">
            <div class="inline-flex items-center justify-center w-16 h-16 bg-gray-100 dark:bg-gray-800 rounded-full mb-4">
                <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"></path>
                </svg>
            </div>
            <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-2">No users found</h3>
            <p class="text-gray-600 dark:text-gray-400 mb-6">Get started by creating a new user account.</p>
            <a href="{{ route('admin.users.create') }}" class="inline-flex items-center px-4 py-2 bg-brand-600 text-white rounded-lg hover:bg-brand-700">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                </svg>
                Add User
            </a>
        </div>
        @endforelse
    </div>

    <!-- Pagination -->
    @if($users->hasPages())
    <div class="flex justify-center mt-8">
        {{ $users->links() }}
    </div>
    @endif
</div>
@endsection

