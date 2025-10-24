@extends('layouts.app')

@section('title', 'Latest Posts — ' . config('app.name'))
@section('meta')
    <x-seo-meta 
        title="Latest Posts — {{ config('app.name') }}"
        description="Read the latest tutorials, guides, and articles on {{ config('app.name') }}."
        url="{{ url()->current() }}"
        type="website"
        canonical="{{ url()->current() }}"
    />
@endsection

@section('content')
    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
        <x-ad-slot position="header" />

        <!-- Hero Section -->
        <section class="mb-8 sm:mb-12">
            <div class="relative overflow-hidden bg-gradient-to-r from-blue-600 via-purple-600 to-indigo-600 rounded-xl sm:rounded-2xl shadow-xl">
                <div class="absolute inset-0 bg-black opacity-20"></div>
                <div class="relative px-6 py-12 sm:px-8 sm:py-16 lg:px-16 lg:py-20">
                    <div class="max-w-3xl">
                        <h1 class="text-3xl sm:text-4xl lg:text-5xl xl:text-6xl font-bold text-white leading-tight">
                            Latest Tutorials, Reviews & Tools
                        </h1>
                        <p class="mt-4 sm:mt-6 text-lg sm:text-xl text-blue-100 leading-relaxed">
                            Curated tech guides, honest reviews, and developer tools to level up your workflow.
                        </p>
                        <div class="mt-6 sm:mt-8 flex flex-col sm:flex-row gap-3 sm:gap-4">
                            <a href="#posts" class="inline-flex items-center justify-center px-4 sm:px-6 py-3 bg-white text-blue-600 font-semibold rounded-lg hover:bg-gray-50 transition-colors">
                                Explore Posts
                                <svg class="ml-2 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </a>
                            <a href="{{ route('categories.index') }}" class="inline-flex items-center justify-center px-4 sm:px-6 py-3 border-2 border-white text-white font-semibold rounded-lg hover:bg-white hover:text-blue-600 transition-colors">
                                Browse Categories
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Featured + Grid -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 lg:gap-8">
            <!-- Main Content -->
            <div class="lg:col-span-2 space-y-6 lg:space-y-8">
                @if($posts->count())
                    @php $first = $posts->first(); @endphp
                    <!-- Featured Post -->
                    <article class="bg-white dark:bg-gray-800 rounded-lg sm:rounded-xl shadow-lg overflow-hidden border border-gray-200 dark:border-gray-700 hover:shadow-xl transition-shadow">
                        @if($first->thumbnail)
                            <div class="w-full h-48 sm:h-64">
                                <img src="{{ $first->thumbnail }}" alt="{{ $first->title }}" class="w-full h-full object-cover">
                            </div>
                        @endif
                        <div class="p-6 sm:p-8">
                            <div class="flex flex-wrap items-center gap-2 sm:gap-4 text-sm text-gray-500 mb-4">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                    Featured
                                </span>
                                <span>{{ optional($first->published_at)->format('M d, Y') }}</span>
                                <span>{{ $first->reading_time }} min read</span>
                                @if($first->category)
                                    <span class="text-blue-600">{{ $first->category->name }}</span>
                                @endif
                            </div>
                            <h2 class="text-2xl sm:text-3xl font-bold text-gray-900 dark:text-gray-100 mb-4">
                                <a href="{{ route('posts.show', $first) }}" class="hover:text-blue-600 transition-colors">
                                    {{ $first->title }}
                                </a>
                            </h2>
                            <p class="text-base sm:text-lg text-gray-600 mb-6 leading-relaxed">{{ $first->excerpt }}</p>
                            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                                <div class="flex items-center space-x-3">
                                    <div class="w-10 h-10 bg-gradient-to-r from-blue-500 to-purple-500 rounded-full flex items-center justify-center">
                                        <span class="text-white font-semibold text-sm">{{ substr($first->user?->name ?? 'A', 0, 1) }}</span>
                                    </div>
                                    <div>
                                        <p class="text-sm font-medium text-gray-900 dark:text-gray-100">{{ $first->user?->name ?? 'Anonymous' }}</p>
                                        <p class="text-xs text-gray-500">{{ $first->views }} views</p>
                                    </div>
                                </div>
                                <a href="{{ route('posts.show', $first) }}" class="inline-flex items-center justify-center px-6 py-3 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 transition-colors">
                                    Read Full
                                    <svg class="ml-2 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </article>

                    <!-- Grid of other posts -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 sm:gap-6">
                        @foreach($posts->skip(1) as $post)
                            <article class="bg-white dark:bg-gray-800 rounded-lg shadow-md overflow-hidden border border-gray-200 dark:border-gray-700 hover:shadow-lg transition-shadow">
                                @if($post->thumbnail)
                                    <div class="w-full h-40 sm:h-48">
                                        <img src="{{ $post->thumbnail }}" alt="{{ $post->title }}" class="w-full h-full object-cover">
                                    </div>
                                @endif
                                <div class="p-4 sm:p-6">
                                    <div class="flex flex-wrap items-center gap-1 sm:gap-2 text-xs text-gray-500 mb-3">
                                        <span>{{ optional($post->published_at)->format('M d, Y') }}</span>
                                        <span>•</span>
                                        <span>{{ $post->reading_time }} min read</span>
                                        @if($post->category)
                                            <span>•</span>
                                            <span class="text-blue-600">{{ $post->category->name }}</span>
                                        @endif
                                    </div>
                                    <h3 class="text-base sm:text-lg font-semibold text-gray-900 mb-2 line-clamp-2">
                                        <a href="{{ route('posts.show', $post) }}" class="hover:text-blue-600 transition-colors">
                                            {{ $post->title }}
                                        </a>
                                    </h3>
                                    <p class="text-gray-600 text-sm line-clamp-3 mb-4">{{ $post->excerpt }}</p>
                                    <div class="flex items-center justify-between">
                                        <div class="flex items-center space-x-2">
                                            <div class="w-6 h-6 bg-gray-300 rounded-full flex items-center justify-center">
                                                <span class="text-xs font-medium text-gray-700">{{ substr($post->user?->name ?? 'A', 0, 1) }}</span>
                                            </div>
                                            <span class="text-xs text-gray-500">{{ $post->user?->name ?? 'Anonymous' }}</span>
                                        </div>
                                        <span class="text-xs text-gray-400">{{ $post->views }} views</span>
                                    </div>
                                </div>
                            </article>
                        @endforeach
                    </div>

                    <!-- Pagination -->
                    <div class="mt-6 sm:mt-8">
                        {{ $posts->links() }}
                    </div>
                @else
                    <div class="text-center py-12">
                        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                        <h3 class="mt-2 text-sm font-medium text-gray-900 dark:text-gray-100">No posts yet</h3>
                        <p class="mt-1 text-sm text-gray-500">Check back later for new content.</p>
                    </div>
                @endif
            </div>

            <!-- Sidebar -->
            <aside class="space-y-4 sm:space-y-6">
                <!-- Newsletter -->
                <div class="bg-gradient-to-br from-blue-50 to-indigo-50 dark:from-transparent dark:to-transparent rounded-lg sm:rounded-xl p-4 sm:p-6 border border-blue-200 dark:border-gray-700 dark:bg-gradient-to-br dark:from-gray-800 dark:to-gray-900">
                    <div class="text-center">
                        <div class="w-10 h-10 sm:w-12 sm:h-12 bg-blue-600 rounded-full flex items-center justify-center mx-auto mb-3 sm:mb-4">
                            <svg class="w-5 h-5 sm:w-6 sm:h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                        <h3 class="text-base sm:text-lg font-semibold text-gray-900 dark:text-gray-100 mb-2">Stay Updated</h3>
                        <p class="text-sm text-gray-700 dark:text-gray-300 mb-4">Get weekly updates with our best tutorials and tools.</p>
                        <x-newsletter-form />
                    </div>
                </div>

                <!-- Ad Slot -->
                <x-ad-slot position="sidebar_top" />

                <!-- Categories -->
                <div class="bg-white dark:bg-gray-800 rounded-lg sm:rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 p-4 sm:p-6">
                    <h3 class="text-base sm:text-lg font-semibold text-gray-900 dark:text-gray-100 mb-4">Popular Categories</h3>
                    <div class="space-y-2 sm:space-y-3">
                        @php
                            $categories = \App\Models\Category::withCount('posts')->orderByDesc('posts_count')->limit(5)->get();
                        @endphp
                        @foreach($categories as $category)
                            <a href="{{ route('categories.show', $category) }}" class="flex items-center justify-between p-2 sm:p-3 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                                <div class="flex items-center space-x-2 sm:space-x-3">
                                    <div class="w-6 h-6 sm:w-8 sm:h-8 bg-gradient-to-r from-blue-500 to-purple-500 rounded-lg flex items-center justify-center">
                                        <span class="text-white font-semibold text-xs">{{ substr($category->name, 0, 1) }}</span>
                                    </div>
                                    <span class="text-sm font-medium text-gray-900 dark:text-gray-100">{{ $category->name }}</span>
                                </div>
                                <span class="text-xs text-gray-500 dark:text-gray-300 bg-gray-100 dark:bg-gray-800 px-2 py-1 rounded-full">{{ $category->posts_count }}</span>
                            </a>
                        @endforeach
                    </div>
                    <div class="mt-4">
                        <a href="{{ route('categories.index') }}" class="text-blue-600 hover:text-blue-800 text-sm font-medium">View all categories →</a>
                    </div>
                </div>

                <!-- Ad Slot -->
                <x-ad-slot position="sidebar_bottom" />
            </aside>
        </div>

        <!-- Footer Ad -->
        <div class="mt-8 sm:mt-12">
            <x-ad-slot position="footer" />
        </div>
    </div>
@endsection


