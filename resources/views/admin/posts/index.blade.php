@extends('layouts.admin')

@section('admin-content')
<div class="space-y-6">
    <!-- Header -->
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
        <div>
            <h1 class="text-3xl font-bold bg-gradient-to-r from-brand-600 to-accent-600 bg-clip-text text-transparent">Posts</h1>
            <p class="text-gray-600 dark:text-gray-300 mt-1">Manage your blog content</p>
        </div>
        <div class="flex flex-wrap items-center gap-3">
            <div class="relative">
                <input type="text" placeholder="Search posts..." class="pl-10 pr-4 py-2 border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 rounded-lg focus:ring-2 focus:ring-brand-500 focus:border-transparent text-sm">
                <svg class="w-4 h-4 absolute left-3 top-1/2 -translate-y-1/2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                </svg>
            </div>
            <a href="{{ route('admin.posts.create') }}" class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-brand-600 to-accent-600 hover:from-brand-700 hover:to-accent-700 text-white text-sm font-medium rounded-lg shadow-lg hover:shadow-xl transition-all duration-300 hover:scale-105">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                </svg>
                New Post
            </a>
        </div>
    </div>

    <!-- Success Message -->
    @if(session('success'))
    <div class="bg-green-50 dark:bg-green-900/30 border border-green-200 dark:border-green-700 rounded-xl p-4 flex items-center space-x-3">
        <div class="flex-shrink-0">
            <svg class="h-5 w-5 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
            </svg>
        </div>
        <p class="text-sm font-medium text-green-800 dark:text-green-100">{{ session('success') }}</p>
    </div>
    @endif

    <!-- Filter Tabs -->
    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 p-4">
        <div class="flex flex-wrap gap-2">
            <button class="px-4 py-2 bg-brand-100 dark:bg-brand-900/30 text-brand-700 dark:text-brand-300 rounded-lg font-medium text-sm">
                All ({{ $posts->total() }})
            </button>
            <button class="px-4 py-2 bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300 hover:bg-gray-200 dark:hover:bg-gray-600 rounded-lg font-medium text-sm transition-colors">
                Published
            </button>
            <button class="px-4 py-2 bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300 hover:bg-gray-200 dark:hover:bg-gray-600 rounded-lg font-medium text-sm transition-colors">
                Draft
            </button>
            <button class="px-4 py-2 bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300 hover:bg-gray-200 dark:hover:bg-gray-600 rounded-lg font-medium text-sm transition-colors">
                Scheduled
            </button>
        </div>
    </div>

    <!-- Posts Grid -->
    <div class="grid grid-cols-1 gap-6">
        @forelse($posts as $post)
        <div class="group bg-white dark:bg-gray-800 rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 border border-gray-200 dark:border-gray-700 overflow-hidden">
            <div class="flex flex-col sm:flex-row gap-6 p-6">
                <!-- Thumbnail -->
                <div class="flex-shrink-0">
                    @if($post->thumbnail)
                    <img src="{{ $post->thumbnail }}" alt="{{ $post->title }}" class="w-full sm:w-32 h-32 rounded-xl object-cover group-hover:scale-105 transition-transform duration-300">
                    @else
                    <div class="w-full sm:w-32 h-32 bg-gradient-to-br from-brand-600 to-accent-600 rounded-xl flex items-center justify-center">
                        <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                    </div>
                    @endif
                </div>

                <!-- Content -->
                <div class="flex-1 min-w-0">
                    <div class="flex items-start justify-between mb-2">
                        <div class="flex-1 mr-4">
                            <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-1 group-hover:text-brand-600 dark:group-hover:text-brand-400 transition-colors">
                                {{ $post->title }}
                            </h3>
                            <p class="text-sm text-gray-600 dark:text-gray-400 line-clamp-2">{{ $post->excerpt }}</p>
                        </div>
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold flex-shrink-0
                            @if($post->status === 'published') bg-green-100 dark:bg-green-900/30 text-green-800 dark:text-green-300
                            @elseif($post->status === 'draft') bg-amber-100 dark:bg-amber-900/30 text-amber-800 dark:text-amber-300
                            @else bg-blue-100 dark:bg-blue-900/30 text-blue-800 dark:text-blue-300
                            @endif">
                            {{ ucfirst($post->status) }}
                        </span>
                    </div>

                    <!-- Meta Info -->
                    <div class="flex flex-wrap items-center gap-4 text-sm text-gray-500 dark:text-gray-400 mt-3 mb-4">
                        @if($post->category)
                        <div class="flex items-center space-x-1">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                            </svg>
                            <span>{{ $post->category->name }}</span>
                        </div>
                        @endif
                        <div class="flex items-center space-x-1">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                            <span>{{ $post->user?->name ?? 'Unknown' }}</span>
                        </div>
                        <div class="flex items-center space-x-1">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                            <span>{{ $post->published_at ? $post->published_at->format('M j, Y') : $post->created_at->format('M j, Y') }}</span>
                        </div>
                        <div class="flex items-center space-x-1">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                            </svg>
                            <span>{{ number_format($post->views) }} views</span>
                        </div>
                    </div>

                    <!-- Actions -->
                    <div class="flex items-center space-x-2">
                        <a href="{{ route('posts.show', $post) }}" target="_blank" class="inline-flex items-center px-3 py-1.5 bg-gray-100 dark:bg-gray-700 hover:bg-gray-200 dark:hover:bg-gray-600 text-gray-700 dark:text-gray-300 rounded-lg text-sm font-medium transition-colors">
                            <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                            </svg>
                            View
                        </a>
                        <a href="{{ route('admin.posts.edit', $post) }}" class="inline-flex items-center px-3 py-1.5 bg-brand-100 dark:bg-brand-900/30 hover:bg-brand-200 dark:hover:bg-brand-900/50 text-brand-700 dark:text-brand-300 rounded-lg text-sm font-medium transition-colors">
                            <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                            </svg>
                            Edit
                        </a>
                        <form action="{{ route('admin.posts.destroy', $post) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this post?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="inline-flex items-center px-3 py-1.5 bg-red-100 dark:bg-red-900/30 hover:bg-red-200 dark:hover:bg-red-900/50 text-red-700 dark:text-red-300 rounded-lg text-sm font-medium transition-colors">
                                <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                </svg>
                                Delete
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @empty
        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg border border-gray-200 dark:border-gray-700 p-12">
            <div class="text-center">
                <svg class="mx-auto h-16 w-16 text-gray-400 dark:text-gray-500 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                </svg>
                <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-2">No posts found</h3>
                <p class="text-gray-500 dark:text-gray-400 mb-6">Get started by creating your first blog post.</p>
                <a href="{{ route('admin.posts.create') }}" class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-brand-600 to-accent-600 hover:from-brand-700 hover:to-accent-700 text-white rounded-lg font-medium shadow-lg hover:shadow-xl transition-all duration-300 hover:scale-105">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                    Create Your First Post
                </a>
            </div>
        </div>
        @endforelse
    </div>

    <!-- Pagination -->
    @if($posts->hasPages())
    <div class="flex justify-center">
        {{ $posts->links() }}
    </div>
    @endif
</div>
@endsection
