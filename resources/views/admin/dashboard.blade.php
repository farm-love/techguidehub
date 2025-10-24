@extends('layouts.admin')

@section('admin-content')
<div class="space-y-6">
    <!-- Header -->
    <div class="flex justify-between items-center">
        <div>
            <h1 class="text-3xl font-bold text-gray-900 dark:text-gray-100">Dashboard</h1>
            <p class="text-gray-600 dark:text-gray-300">Welcome back, {{ auth()->user()->name }}!</p>
        </div>
        <div class="text-sm text-gray-500">
            {{ now()->format('l, F j, Y') }}
        </div>
    </div>

    <!-- Stats Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm p-6 border border-gray-200 dark:border-gray-700">
            <div class="flex items-center">
                <div class="p-2 bg-blue-100 rounded-lg">
                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600 dark:text-gray-300">Total Posts</p>
                    <p class="text-2xl font-semibold text-gray-900 dark:text-gray-100">{{ $stats['posts'] }}</p>
                </div>
            </div>
        </div>

    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm p-6 border border-gray-200 dark:border-gray-700">
            <div class="flex items-center">
                <div class="p-2 bg-green-100 rounded-lg">
                    <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600 dark:text-gray-300">Published</p>
                    <p class="text-2xl font-semibold text-gray-900 dark:text-gray-100">{{ $stats['published_posts'] }}</p>
                </div>
            </div>
        </div>

    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm p-6 border border-gray-200 dark:border-gray-700">
            <div class="flex items-center">
                <div class="p-2 bg-yellow-100 rounded-lg">
                    <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600 dark:text-gray-300">Drafts</p>
                    <p class="text-2xl font-semibold text-gray-900 dark:text-gray-100">{{ $stats['draft_posts'] }}</p>
                </div>
            </div>
        </div>

    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm p-6 border border-gray-200 dark:border-gray-700">
            <div class="flex items-center">
                <div class="p-2 bg-purple-100 rounded-lg">
                    <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"></path>
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600 dark:text-gray-300">Users</p>
                    <p class="text-2xl font-semibold text-gray-900 dark:text-gray-100">{{ $stats['users'] }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Posts & Top Categories -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Recent Posts -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700">
            <div class="p-6 border-b border-gray-200 dark:border-gray-700">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">Recent Posts</h3>
            </div>
            <div class="p-6">
                <div class="space-y-4">
                    @forelse($recentPosts as $post)
                    <div class="flex items-center justify-between">
                        <div class="flex-1">
                            <h4 class="text-sm font-medium text-gray-900 dark:text-gray-100">{{ $post->title }}</h4>
                            <p class="text-xs text-gray-500 dark:text-gray-300">{{ $post->created_at->format('M j, Y') }} • {{ $post->status }}</p>
                        </div>
                        <div class="flex items-center space-x-2">
                            <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium
                                @if($post->status === 'published') bg-green-100 text-green-800
                                @elseif($post->status === 'draft') bg-yellow-100 text-yellow-800
                                @else bg-blue-100 text-blue-800
                                @endif">
                                {{ ucfirst($post->status) }}
                            </span>
                            <a href="{{ route('admin.posts.edit', $post) }}" class="text-blue-600 hover:text-blue-800 text-sm">Edit</a>
                        </div>
                    </div>
                    @empty
                    <p class="text-gray-500 text-sm">No posts yet.</p>
                    @endforelse
                </div>
                <div class="mt-4">
                    <a href="{{ route('admin.posts.index') }}" class="text-blue-600 hover:text-blue-800 text-sm font-medium">View all posts →</a>
                </div>
            </div>
        </div>

        <!-- Top Categories -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700">
            <div class="p-6 border-b border-gray-200 dark:border-gray-700">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">Top Categories</h3>
            </div>
            <div class="p-6">
                <div class="space-y-4">
                    @forelse($topCategories as $category)
                    <div class="flex items-center justify-between">
                        <div class="flex-1">
                            <h4 class="text-sm font-medium text-gray-900 dark:text-gray-100">{{ $category->name }}</h4>
                            <p class="text-xs text-gray-500 dark:text-gray-300">{{ $category->posts_count }} posts</p>
                        </div>
                        <div class="flex items-center space-x-2">
                            <div class="w-16 bg-gray-200 rounded-full h-2">
                                <div class="bg-blue-600 h-2 rounded-full" style="width: {{ min(100, ($category->posts_count / max(1, $topCategories->max('posts_count'))) * 100) }}%"></div>
                            </div>
                        </div>
                    </div>
                    @empty
                    <p class="text-gray-500 text-sm">No categories yet.</p>
                    @endforelse
                </div>
                @if(auth()->user()->role === 'admin')
                <div class="mt-4">
                    <a href="{{ route('admin.categories.index') }}" class="text-blue-600 hover:text-blue-800 text-sm font-medium">Manage categories →</a>
                </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700">
        <div class="p-6 border-b border-gray-200 dark:border-gray-700">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">Quick Actions</h3>
        </div>
        <div class="p-6">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                <a href="{{ route('admin.posts.create') }}" class="flex items-center p-4 bg-blue-50 rounded-lg hover:bg-blue-100 transition-colors">
                    <div class="p-2 bg-blue-100 rounded-lg mr-3">
                        <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                    </div>
                    <div>
                        <h4 class="text-sm font-medium text-blue-900">New Post</h4>
                        <p class="text-xs text-blue-700">Create a new blog post</p>
                    </div>
                </a>

                @if(auth()->user()->role === 'admin')
                <a href="{{ route('admin.categories.create') }}" class="flex items-center p-4 bg-green-50 rounded-lg hover:bg-green-100 transition-colors">
                    <div class="p-2 bg-green-100 rounded-lg mr-3">
                        <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                        </svg>
                    </div>
                    <div>
                        <h4 class="text-sm font-medium text-green-900">New Category</h4>
                        <p class="text-xs text-green-700">Add a new category</p>
                    </div>
                </a>

                <a href="{{ route('admin.users.create') }}" class="flex items-center p-4 bg-purple-50 rounded-lg hover:bg-purple-100 transition-colors">
                    <div class="p-2 bg-purple-100 rounded-lg mr-3">
                        <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"></path>
                        </svg>
                    </div>
                    <div>
                        <h4 class="text-sm font-medium text-purple-900">New User</h4>
                        <p class="text-xs text-purple-700">Add a new user</p>
                    </div>
                </a>

                <a href="{{ route('admin.settings.index') }}" class="flex items-center p-4 bg-gray-50 dark:bg-gray-800 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors">
                    <div class="p-2 bg-gray-100 dark:bg-gray-700 rounded-lg mr-3">
                        <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                    </div>
                    <div>
                        <h4 class="text-sm font-medium text-gray-900">Settings</h4>
                        <p class="text-xs text-gray-700">Manage site settings</p>
                    </div>
                </a>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
