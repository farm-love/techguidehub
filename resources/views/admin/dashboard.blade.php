@extends('layouts.admin')

@section('admin-content')
<div class="space-y-8">
    <!-- Header -->
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
        <div>
            <h1 class="text-3xl lg:text-4xl font-bold bg-gradient-to-r from-brand-600 to-accent-600 bg-clip-text text-transparent">
                Dashboard
            </h1>
            <p class="text-gray-600 dark:text-gray-300 mt-1">Welcome back, <span class="font-semibold">{{ auth()->user()->name }}</span>!</p>
        </div>
        <div class="flex items-center space-x-3">
            <div class="text-sm text-gray-500 dark:text-gray-400">
                <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                </svg>
                {{ now()->format('l, F j, Y') }}
            </div>
        </div>
    </div>

    <!-- Stats Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
        <!-- Total Posts -->
        <div class="group bg-white dark:bg-gray-800 rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 p-6 border border-gray-200 dark:border-gray-700 hover:border-brand-500 dark:hover:border-brand-500">
            <div class="flex items-center justify-between mb-4">
                <div class="p-3 bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl shadow-lg">
                    <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                </div>
                <span class="text-xs font-semibold text-green-600 dark:text-green-400 bg-green-100 dark:bg-green-900/30 px-2 py-1 rounded-full">
                    +12%
                </span>
            </div>
            <div>
                <p class="text-sm font-medium text-gray-600 dark:text-gray-400 mb-1">Total Posts</p>
                <p class="text-3xl font-bold text-gray-900 dark:text-gray-100">{{ $stats['posts'] }}</p>
                <p class="text-xs text-gray-500 dark:text-gray-400 mt-2">All content</p>
            </div>
        </div>

        <!-- Published Posts -->
        <div class="group bg-white dark:bg-gray-800 rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 p-6 border border-gray-200 dark:border-gray-700 hover:border-green-500 dark:hover:border-green-500">
            <div class="flex items-center justify-between mb-4">
                <div class="p-3 bg-gradient-to-br from-green-500 to-green-600 rounded-xl shadow-lg">
                    <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <span class="text-xs font-semibold text-green-600 dark:text-green-400 bg-green-100 dark:bg-green-900/30 px-2 py-1 rounded-full">
                    +8%
                </span>
            </div>
            <div>
                <p class="text-sm font-medium text-gray-600 dark:text-gray-400 mb-1">Published</p>
                <p class="text-3xl font-bold text-gray-900 dark:text-gray-100">{{ $stats['published_posts'] }}</p>
                <p class="text-xs text-gray-500 dark:text-gray-400 mt-2">Live content</p>
            </div>
        </div>

        <!-- Draft Posts -->
        <div class="group bg-white dark:bg-gray-800 rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 p-6 border border-gray-200 dark:border-gray-700 hover:border-amber-500 dark:hover:border-amber-500">
            <div class="flex items-center justify-between mb-4">
                <div class="p-3 bg-gradient-to-br from-amber-500 to-amber-600 rounded-xl shadow-lg">
                    <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                    </svg>
                </div>
                <span class="text-xs font-semibold text-amber-600 dark:text-amber-400 bg-amber-100 dark:bg-amber-900/30 px-2 py-1 rounded-full">
                    {{ $stats['draft_posts'] }}
                </span>
            </div>
            <div>
                <p class="text-sm font-medium text-gray-600 dark:text-gray-400 mb-1">Drafts</p>
                <p class="text-3xl font-bold text-gray-900 dark:text-gray-100">{{ $stats['draft_posts'] }}</p>
                <p class="text-xs text-gray-500 dark:text-gray-400 mt-2">In progress</p>
            </div>
        </div>

        <!-- Users -->
        <div class="group bg-white dark:bg-gray-800 rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 p-6 border border-gray-200 dark:border-gray-700 hover:border-purple-500 dark:hover:border-purple-500">
            <div class="flex items-center justify-between mb-4">
                <div class="p-3 bg-gradient-to-br from-purple-500 to-purple-600 rounded-xl shadow-lg">
                    <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"></path>
                    </svg>
                </div>
                <span class="text-xs font-semibold text-purple-600 dark:text-purple-400 bg-purple-100 dark:bg-purple-900/30 px-2 py-1 rounded-full">
                    +3
                </span>
            </div>
            <div>
                <p class="text-sm font-medium text-gray-600 dark:text-gray-400 mb-1">Total Users</p>
                <p class="text-3xl font-bold text-gray-900 dark:text-gray-100">{{ $stats['users'] }}</p>
                <p class="text-xs text-gray-500 dark:text-gray-400 mt-2">Active members</p>
            </div>
        </div>
    </div>

    <!-- Additional Stats Row -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        <!-- Categories -->
        <div class="bg-gradient-to-br from-brand-50 to-accent-50 dark:from-gray-800 dark:to-gray-800 rounded-2xl p-6 border border-brand-200 dark:border-gray-700">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Categories</p>
                    <p class="text-2xl font-bold text-gray-900 dark:text-gray-100 mt-1">{{ $stats['categories'] }}</p>
                </div>
                <div class="p-3 bg-brand-600 rounded-xl">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Tags -->
        <div class="bg-gradient-to-br from-cyan-50 to-blue-50 dark:from-gray-800 dark:to-gray-800 rounded-2xl p-6 border border-cyan-200 dark:border-gray-700">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Tags</p>
                    <p class="text-2xl font-bold text-gray-900 dark:text-gray-100 mt-1">{{ $stats['tags'] }}</p>
                </div>
                <div class="p-3 bg-cyan-600 rounded-xl">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 20l4-16m2 16l4-16M6 9h14M4 15h14"/>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Ads -->
        <div class="bg-gradient-to-br from-pink-50 to-rose-50 dark:from-gray-800 dark:to-gray-800 rounded-2xl p-6 border border-pink-200 dark:border-gray-700">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Active Ads</p>
                    <p class="text-2xl font-bold text-gray-900 dark:text-gray-100 mt-1">{{ $stats['ads'] }}</p>
                </div>
                <div class="p-3 bg-pink-600 rounded-xl">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"/>
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts and Data Visualization -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Post Status Chart -->
        <div class="lg:col-span-2 bg-white dark:bg-gray-800 rounded-2xl shadow-lg border border-gray-200 dark:border-gray-700 overflow-hidden">
            <div class="p-6 border-b border-gray-200 dark:border-gray-700">
                <h3 class="text-lg font-bold text-gray-900 dark:text-gray-100">Content Overview</h3>
                <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Distribution of posts by status</p>
            </div>
            <div class="p-6">
                <div class="space-y-4">
                    @php
                        $total = max(1, $stats['posts']);
                        $statuses = [
                            ['name' => 'Published', 'count' => $stats['published_posts'], 'color' => 'bg-green-500', 'text' => 'text-green-600'],
                            ['name' => 'Draft', 'count' => $stats['draft_posts'], 'color' => 'bg-amber-500', 'text' => 'text-amber-600'],
                            ['name' => 'Scheduled', 'count' => $stats['scheduled_posts'], 'color' => 'bg-blue-500', 'text' => 'text-blue-600'],
                        ];
                    @endphp
                    
                    @foreach($statuses as $status)
                    <div>
                        <div class="flex items-center justify-between mb-2">
                            <div class="flex items-center space-x-2">
                                <div class="w-3 h-3 rounded-full {{ $status['color'] }}"></div>
                                <span class="text-sm font-medium text-gray-700 dark:text-gray-300">{{ $status['name'] }}</span>
                            </div>
                            <div class="flex items-center space-x-3">
                                <span class="text-sm font-bold {{ $status['text'] }}">{{ $status['count'] }}</span>
                                <span class="text-xs text-gray-500 dark:text-gray-400">{{ round(($status['count'] / $total) * 100) }}%</span>
                            </div>
                        </div>
                        <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-3 overflow-hidden">
                            <div class="{{ $status['color'] }} h-3 rounded-full transition-all duration-500" 
                                 style="width: {{ ($status['count'] / $total) * 100 }}%"></div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Quick Stats -->
        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg border border-gray-200 dark:border-gray-700 overflow-hidden">
            <div class="p-6 border-b border-gray-200 dark:border-gray-700">
                <h3 class="text-lg font-bold text-gray-900 dark:text-gray-100">Quick Stats</h3>
            </div>
            <div class="p-6 space-y-4">
                @php
                    $quickStats = [
                        ['label' => 'Avg. Posts/Day', 'value' => round($stats['published_posts'] / max(1, now()->diffInDays(now()->subMonth())), 1), 'icon' => 'M13 7h8m0 0v8m0-8l-8 8-4-4-6 6'],
                        ['label' => 'Total Views', 'value' => number_format(\App\Models\Post::sum('views')), 'icon' => 'M15 12a3 3 0 11-6 0 3 3 0 016 0z M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z'],
                        ['label' => 'Avg. Reading Time', 'value' => round(\App\Models\Post::avg('reading_time') ?? 0) . ' min', 'icon' => 'M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z'],
                    ];
                @endphp
                
                @foreach($quickStats as $stat)
                <div class="flex items-center justify-between p-3 bg-gray-50 dark:bg-gray-700/50 rounded-lg">
                    <div class="flex items-center space-x-3">
                        <div class="p-2 bg-brand-100 dark:bg-brand-900/30 rounded-lg">
                            <svg class="w-4 h-4 text-brand-600 dark:text-brand-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $stat['icon'] }}"/>
                            </svg>
                        </div>
                        <span class="text-xs font-medium text-gray-600 dark:text-gray-400">{{ $stat['label'] }}</span>
                    </div>
                    <span class="text-sm font-bold text-gray-900 dark:text-gray-100">{{ $stat['value'] }}</span>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Recent Posts & Top Categories -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Recent Posts -->
        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg border border-gray-200 dark:border-gray-700 overflow-hidden">
            <div class="p-6 border-b border-gray-200 dark:border-gray-700 flex items-center justify-between">
                <div>
                    <h3 class="text-lg font-bold text-gray-900 dark:text-gray-100">Recent Posts</h3>
                    <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Latest content updates</p>
                </div>
                <a href="{{ route('admin.posts.index') }}" class="text-brand-600 hover:text-brand-700 dark:text-brand-400 text-sm font-medium">
                    View All →
                </a>
            </div>
            <div class="p-6">
                <div class="space-y-4">
                    @forelse($recentPosts as $post)
                    <div class="group flex items-start gap-4 p-3 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-colors">
                        @if($post->thumbnail)
                        <img src="{{ $post->thumbnail }}" alt="{{ $post->title }}" class="w-16 h-16 rounded-lg object-cover flex-shrink-0">
                        @else
                        <div class="w-16 h-16 bg-gradient-to-br from-brand-600 to-accent-600 rounded-lg flex items-center justify-center flex-shrink-0">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                        </div>
                        @endif
                        <div class="flex-1 min-w-0">
                            <h4 class="text-sm font-medium text-gray-900 dark:text-gray-100 line-clamp-2 group-hover:text-brand-600 dark:group-hover:text-brand-400">
                                {{ $post->title }}
                            </h4>
                            <div class="flex items-center gap-2 mt-2">
                                <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium
                                    @if($post->status === 'published') bg-green-100 dark:bg-green-900/30 text-green-800 dark:text-green-300
                                    @elseif($post->status === 'draft') bg-amber-100 dark:bg-amber-900/30 text-amber-800 dark:text-amber-300
                                    @else bg-blue-100 dark:bg-blue-900/30 text-blue-800 dark:text-blue-300
                                    @endif">
                                    {{ ucfirst($post->status) }}
                                </span>
                                <span class="text-xs text-gray-500 dark:text-gray-400">{{ $post->created_at->diffForHumans() }}</span>
                            </div>
                        </div>
                        <a href="{{ route('admin.posts.edit', $post) }}" class="flex-shrink-0 p-2 text-gray-400 hover:text-brand-600 dark:hover:text-brand-400 hover:bg-brand-50 dark:hover:bg-brand-900/20 rounded-lg transition-colors">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                            </svg>
                        </a>
                    </div>
                    @empty
                    <div class="text-center py-8">
                        <svg class="w-12 h-12 mx-auto text-gray-300 dark:text-gray-600 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                        <p class="text-gray-500 dark:text-gray-400 text-sm">No posts yet</p>
                    </div>
                    @endforelse
                </div>
            </div>
        </div>

        <!-- Top Categories -->
        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg border border-gray-200 dark:border-gray-700 overflow-hidden">
            <div class="p-6 border-b border-gray-200 dark:border-gray-700 flex items-center justify-between">
                <div>
                    <h3 class="text-lg font-bold text-gray-900 dark:text-gray-100">Top Categories</h3>
                    <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Most popular topics</p>
                </div>
                @if(auth()->user()->role === 'admin')
                <a href="{{ route('admin.categories.index') }}" class="text-brand-600 hover:text-brand-700 dark:text-brand-400 text-sm font-medium">
                    Manage →
                </a>
                @endif
            </div>
            <div class="p-6">
                <div class="space-y-4">
                    @forelse($topCategories as $index => $category)
                    <div class="flex items-center gap-4">
                        <div class="flex-shrink-0 w-8 h-8 bg-gradient-to-br from-brand-600 to-accent-600 rounded-lg flex items-center justify-center">
                            <span class="text-white font-bold text-sm">{{ $index + 1 }}</span>
                        </div>
                        <div class="flex-1 min-w-0">
                            <div class="flex items-center justify-between mb-2">
                                <h4 class="text-sm font-medium text-gray-900 dark:text-gray-100">{{ $category->name }}</h4>
                                <span class="text-xs font-bold text-brand-600 dark:text-brand-400">{{ $category->posts_count }}</span>
                            </div>
                            <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-2 overflow-hidden">
                                <div class="bg-gradient-to-r from-brand-600 to-accent-600 h-2 rounded-full transition-all duration-500" 
                                     style="width: {{ min(100, ($category->posts_count / max(1, $topCategories->max('posts_count'))) * 100) }}%"></div>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="text-center py-8">
                        <svg class="w-12 h-12 mx-auto text-gray-300 dark:text-gray-600 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                        </svg>
                        <p class="text-gray-500 dark:text-gray-400 text-sm">No categories yet</p>
                    </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="bg-gradient-to-br from-brand-600 to-accent-600 rounded-2xl shadow-xl overflow-hidden">
        <div class="p-8">
            <h3 class="text-2xl font-bold text-white mb-6">Quick Actions</h3>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                <a href="{{ route('admin.posts.create') }}" class="group bg-white/10 hover:bg-white/20 backdrop-blur rounded-xl p-5 transition-all duration-300 hover:scale-105">
                    <div class="flex items-center space-x-3 mb-3">
                        <div class="p-2 bg-white/20 rounded-lg">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                            </svg>
                        </div>
                        <h4 class="font-bold text-white">New Post</h4>
                    </div>
                    <p class="text-sm text-blue-100">Create fresh content</p>
                </a>

                @if(auth()->user()->role === 'admin')
                <a href="{{ route('admin.categories.create') }}" class="group bg-white/10 hover:bg-white/20 backdrop-blur rounded-xl p-5 transition-all duration-300 hover:scale-105">
                    <div class="flex items-center space-x-3 mb-3">
                        <div class="p-2 bg-white/20 rounded-lg">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                            </svg>
                        </div>
                        <h4 class="font-bold text-white">Category</h4>
                    </div>
                    <p class="text-sm text-blue-100">Add new topic</p>
                </a>

                <a href="{{ route('admin.users.create') }}" class="group bg-white/10 hover:bg-white/20 backdrop-blur rounded-xl p-5 transition-all duration-300 hover:scale-105">
                    <div class="flex items-center space-x-3 mb-3">
                        <div class="p-2 bg-white/20 rounded-lg">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
                            </svg>
                        </div>
                        <h4 class="font-bold text-white">New User</h4>
                    </div>
                    <p class="text-sm text-blue-100">Invite member</p>
                </a>

                <a href="{{ route('admin.settings.index') }}" class="group bg-white/10 hover:bg-white/20 backdrop-blur rounded-xl p-5 transition-all duration-300 hover:scale-105">
                    <div class="flex items-center space-x-3 mb-3">
                        <div class="p-2 bg-white/20 rounded-lg">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                        </div>
                        <h4 class="font-bold text-white">Settings</h4>
                    </div>
                    <p class="text-sm text-blue-100">Configure site</p>
                </a>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
