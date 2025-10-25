@extends('layouts.app')

@section('title', 'Analytics Dashboard')

@section('content')
<div class="min-h-screen bg-gray-50 dark:bg-gray-900">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Header -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900 dark:text-white">Analytics Dashboard</h1>
            <p class="mt-2 text-gray-600 dark:text-gray-400">Track your site's performance and user engagement</p>
        </div>

        <!-- Date Range Selector -->
        <div class="mb-6 flex flex-wrap gap-3">
            <button class="px-4 py-2 bg-brand-600 text-white rounded-lg text-sm font-medium">Last 7 Days</button>
            <button class="px-4 py-2 bg-white dark:bg-gray-800 text-gray-700 dark:text-gray-300 border border-gray-300 dark:border-gray-700 rounded-lg text-sm font-medium hover:bg-gray-50 dark:hover:bg-gray-700">Last 30 Days</button>
            <button class="px-4 py-2 bg-white dark:bg-gray-800 text-gray-700 dark:text-gray-300 border border-gray-300 dark:border-gray-700 rounded-lg text-sm font-medium hover:bg-gray-50 dark:hover:bg-gray-700">Last 90 Days</button>
            <button class="px-4 py-2 bg-white dark:bg-gray-800 text-gray-700 dark:text-gray-300 border border-gray-300 dark:border-gray-700 rounded-lg text-sm font-medium hover:bg-gray-50 dark:hover:bg-gray-700">All Time</button>
        </div>

        <!-- Overview Stats -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            @php
                $totalViews = \App\Models\Post::sum('views');
                $totalPosts = \App\Models\Post::where('status', 'published')->count();
                $totalComments = \App\Models\Comment::where('is_approved', true)->count();
                $totalSubscribers = \App\Models\Subscriber::count();
            @endphp
            
            <div class="bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl p-6 text-white shadow-lg">
                <div class="flex justify-between items-start mb-4">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                    </svg>
                    <span class="text-sm font-medium opacity-90">+12.5%</span>
                </div>
                <h3 class="text-3xl font-bold mb-1">{{ number_format($totalViews) }}</h3>
                <p class="text-blue-100 text-sm">Total Views</p>
            </div>

            <div class="bg-gradient-to-br from-green-500 to-green-600 rounded-xl p-6 text-white shadow-lg">
                <div class="flex justify-between items-start mb-4">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                    <span class="text-sm font-medium opacity-90">+5</span>
                </div>
                <h3 class="text-3xl font-bold mb-1">{{ $totalPosts }}</h3>
                <p class="text-green-100 text-sm">Published Posts</p>
            </div>

            <div class="bg-gradient-to-br from-purple-500 to-purple-600 rounded-xl p-6 text-white shadow-lg">
                <div class="flex justify-between items-start mb-4">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"/>
                    </svg>
                    <span class="text-sm font-medium opacity-90">+{{ $totalComments }}</span>
                </div>
                <h3 class="text-3xl font-bold mb-1">{{ $totalComments }}</h3>
                <p class="text-purple-100 text-sm">Total Comments</p>
            </div>

            <div class="bg-gradient-to-br from-orange-500 to-orange-600 rounded-xl p-6 text-white shadow-lg">
                <div class="flex justify-between items-start mb-4">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                    </svg>
                    <span class="text-sm font-medium opacity-90">+{{ $totalSubscribers }}</span>
                </div>
                <h3 class="text-3xl font-bold mb-1">{{ $totalSubscribers }}</h3>
                <p class="text-orange-100 text-sm">Email Subscribers</p>
            </div>
        </div>

        <!-- Charts Row -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
            <!-- Top Posts -->
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg border border-gray-200 dark:border-gray-700 p-6">
                <h2 class="text-xl font-bold text-gray-900 dark:text-white mb-6">Top 10 Posts by Views</h2>
                <div class="space-y-4">
                    @php
                        $topPosts = \App\Models\Post::where('status', 'published')
                            ->orderByDesc('views')
                            ->take(10)
                            ->get();
                    @endphp
                    @foreach($topPosts as $index => $post)
                    <div class="flex items-center gap-4">
                        <span class="flex-shrink-0 w-8 h-8 bg-gradient-to-br from-brand-600 to-accent-600 text-white rounded-full flex items-center justify-center text-sm font-bold">
                            {{ $index + 1 }}
                        </span>
                        <div class="flex-1 min-w-0">
                            <a href="{{ route('posts.show', $post) }}" target="_blank" class="text-sm font-medium text-gray-900 dark:text-white hover:text-brand-600 dark:hover:text-brand-400 line-clamp-1">
                                {{ $post->title }}
                            </a>
                            <p class="text-xs text-gray-500 dark:text-gray-400">{{ $post->category->name ?? 'Uncategorized' }}</p>
                        </div>
                        <span class="flex-shrink-0 text-sm font-semibold text-gray-700 dark:text-gray-300">
                            {{ number_format($post->views) }}
                        </span>
                    </div>
                    @endforeach
                </div>
            </div>

            <!-- Category Distribution -->
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg border border-gray-200 dark:border-gray-700 p-6">
                <h2 class="text-xl font-bold text-gray-900 dark:text-white mb-6">Posts by Category</h2>
                <div class="space-y-4">
                    @php
                        $categories = \App\Models\Category::withCount(['posts' => function($q) {
                            $q->where('status', 'published');
                        }])->orderByDesc('posts_count')->get();
                        $totalCatPosts = $categories->sum('posts_count');
                    @endphp
                    @foreach($categories as $category)
                    <div>
                        <div class="flex justify-between text-sm mb-2">
                            <span class="font-medium text-gray-700 dark:text-gray-300">{{ $category->name }}</span>
                            <span class="text-gray-600 dark:text-gray-400">{{ $category->posts_count }} ({{ $totalCatPosts > 0 ? round(($category->posts_count / $totalCatPosts) * 100) : 0 }}%)</span>
                        </div>
                        <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-2">
                            <div class="bg-gradient-to-r from-brand-600 to-accent-600 h-2 rounded-full transition-all" style="width: {{ $totalCatPosts > 0 ? ($category->posts_count / $totalCatPosts) * 100 : 0 }}%"></div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Recent Activity -->
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg border border-gray-200 dark:border-gray-700 p-6 mb-8">
            <h2 class="text-xl font-bold text-gray-900 dark:text-white mb-6">Recent Comments</h2>
            <div class="space-y-4">
                @php
                    $recentComments = \App\Models\Comment::with(['user', 'post'])
                        ->where('is_approved', true)
                        ->orderByDesc('created_at')
                        ->take(10)
                        ->get();
                @endphp
                @forelse($recentComments as $comment)
                <div class="flex gap-4 pb-4 border-b border-gray-200 dark:border-gray-700 last:border-0 last:pb-0">
                    <div class="flex-shrink-0 w-10 h-10 bg-gradient-to-br from-brand-600 to-accent-600 rounded-full flex items-center justify-center">
                        <span class="text-sm font-bold text-white">{{ substr($comment->user->name, 0, 1) }}</span>
                    </div>
                    <div class="flex-1 min-w-0">
                        <div class="flex items-center gap-2 mb-1">
                            <span class="font-semibold text-gray-900 dark:text-white text-sm">{{ $comment->user->name }}</span>
                            <span class="text-gray-500 dark:text-gray-400 text-xs">{{ $comment->created_at->diffForHumans() }}</span>
                        </div>
                        <p class="text-sm text-gray-700 dark:text-gray-300 line-clamp-2 mb-1">{{ $comment->content }}</p>
                        <a href="{{ route('posts.show', $comment->post) }}#comments" class="text-xs text-brand-600 dark:text-brand-400 hover:underline">
                            on "{{ $comment->post->title }}"
                        </a>
                    </div>
                </div>
                @empty
                <p class="text-gray-500 dark:text-gray-400 text-center py-4">No comments yet</p>
                @endforelse
            </div>
        </div>

        <!-- User Engagement -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Most Active Authors -->
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg border border-gray-200 dark:border-gray-700 p-6">
                <h2 class="text-xl font-bold text-gray-900 dark:text-white mb-6">Most Active Authors</h2>
                <div class="space-y-4">
                    @php
                        $authors = \App\Models\User::withCount(['posts' => function($q) {
                            $q->where('status', 'published');
                        }])->having('posts_count', '>', 0)->orderByDesc('posts_count')->take(5)->get();
                    @endphp
                    @foreach($authors as $author)
                    <div class="flex items-center gap-3">
                        <div class="flex-shrink-0 w-10 h-10 bg-gradient-to-br from-brand-600 to-accent-600 rounded-full flex items-center justify-center">
                            <span class="text-sm font-bold text-white">{{ substr($author->name, 0, 1) }}</span>
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-medium text-gray-900 dark:text-white line-clamp-1">{{ $author->name }}</p>
                            <p class="text-xs text-gray-500 dark:text-gray-400">{{ $author->posts_count }} posts</p>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            <!-- Pending Comments -->
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg border border-gray-200 dark:border-gray-700 p-6">
                <h2 class="text-xl font-bold text-gray-900 dark:text-white mb-6 flex items-center justify-between">
                    Pending Comments
                    @php
                        $pendingCount = \App\Models\Comment::where('is_approved', false)->count();
                    @endphp
                    @if($pendingCount > 0)
                    <span class="bg-red-500 text-white text-xs font-bold px-2 py-1 rounded-full">{{ $pendingCount }}</span>
                    @endif
                </h2>
                <div class="space-y-4">
                    @php
                        $pendingComments = \App\Models\Comment::with(['user', 'post'])
                            ->where('is_approved', false)
                            ->orderByDesc('created_at')
                            ->take(5)
                            ->get();
                    @endphp
                    @forelse($pendingComments as $comment)
                    <div class="p-3 bg-yellow-50 dark:bg-yellow-900/20 border border-yellow-200 dark:border-yellow-800 rounded-lg">
                        <p class="text-sm font-medium text-gray-900 dark:text-white mb-1">{{ $comment->user->name }}</p>
                        <p class="text-xs text-gray-700 dark:text-gray-300 line-clamp-2 mb-2">{{ $comment->content }}</p>
                        <a href="{{ route('posts.show', $comment->post) }}#comments" class="text-xs text-brand-600 dark:text-brand-400 hover:underline">
                            View & Approve →
                        </a>
                    </div>
                    @empty
                    <p class="text-gray-500 dark:text-gray-400 text-center py-4 text-sm">No pending comments</p>
                    @endforelse
                </div>
            </div>

            <!-- Quick Stats -->
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg border border-gray-200 dark:border-gray-700 p-6">
                <h2 class="text-xl font-bold text-gray-900 dark:text-white mb-6">Quick Stats</h2>
                <div class="space-y-4">
                    @php
                        $avgViews = \App\Models\Post::where('status', 'published')->avg('views');
                        $avgReadTime = \App\Models\Post::where('status', 'published')->avg('reading_time');
                        $totalTags = \App\Models\Tag::count();
                        $featuredPosts = \App\Models\Post::where('is_featured', true)->where('status', 'published')->count();
                    @endphp
                    <div class="flex justify-between items-center py-3 border-b border-gray-200 dark:border-gray-700">
                        <span class="text-sm text-gray-600 dark:text-gray-400">Avg. Views per Post</span>
                        <span class="text-sm font-bold text-gray-900 dark:text-white">{{ number_format($avgViews, 0) }}</span>
                    </div>
                    <div class="flex justify-between items-center py-3 border-b border-gray-200 dark:border-gray-700">
                        <span class="text-sm text-gray-600 dark:text-gray-400">Avg. Reading Time</span>
                        <span class="text-sm font-bold text-gray-900 dark:text-white">{{ number_format($avgReadTime, 1) }} min</span>
                    </div>
                    <div class="flex justify-between items-center py-3 border-b border-gray-200 dark:border-gray-700">
                        <span class="text-sm text-gray-600 dark:text-gray-400">Total Tags</span>
                        <span class="text-sm font-bold text-gray-900 dark:text-white">{{ $totalTags }}</span>
                    </div>
                    <div class="flex justify-between items-center py-3">
                        <span class="text-sm text-gray-600 dark:text-gray-400">Featured Posts</span>
                        <span class="text-sm font-bold text-gray-900 dark:text-white">{{ $featuredPosts }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

