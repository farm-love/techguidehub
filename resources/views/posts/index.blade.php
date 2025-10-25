@extends('layouts.app')

@section('title', 'Latest Tutorials & Tech Guides — ' . config('app.name'))
@section('meta')
    <x-seo-meta 
        title="Latest Tutorials & Tech Guides — {{ config('app.name') }}"
        description="Discover the latest tech tutorials, developer tools, and expert insights. Learn, grow, and stay ahead in technology."
        url="{{ url()->current() }}"
        type="website"
        canonical="{{ url()->current() }}"
    />
@endsection

@section('content')
    <!-- Hero Section - Optimized for AdSense -->
    <div class="bg-gradient-to-br from-brand-600 to-accent-600 dark:from-brand-900 dark:to-accent-900">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 sm:py-20">
            <div class="text-center max-w-4xl mx-auto">
                <h1 class="text-4xl sm:text-5xl lg:text-6xl font-extrabold text-white mb-6">
                    Latest Tech Tutorials
                </h1>
                <p class="text-lg sm:text-xl text-blue-100 mb-8">
                    Expert guides, reviews, and tools to accelerate your learning
                </p>
                
                <!-- Search -->
                <div class="max-w-2xl mx-auto">
                    <form action="{{ route('home') }}" method="GET" class="relative">
                        <input type="text" name="q" placeholder="Search tutorials..." value="{{ request('q') }}"
                            class="w-full px-6 py-4 pr-28 rounded-full bg-white dark:bg-gray-800 text-gray-900 dark:text-white shadow-xl focus:outline-none focus:ring-4 focus:ring-white/30">
                        <button type="submit" class="absolute right-2 top-1/2 -translate-y-1/2 px-6 py-2.5 bg-brand-600 hover:bg-brand-700 text-white rounded-full font-medium">
                            Search
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="bg-gray-50 dark:bg-gray-900">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            
            <!-- Top Ad Slot -->
            <div class="mb-12">
                <x-ad-slot position="header" />
            </div>

            <!-- Main Grid: Content + Sidebar -->
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
                
                <!-- Main Content -->
                <div class="lg:col-span-8 space-y-8">
                    
                    <!-- Featured Post -->
                    @if($posts->count() > 0)
                    @php $featured = $posts->first(); @endphp
                    <article class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg overflow-hidden border border-gray-200 dark:border-gray-700 group">
                        @if($featured->thumbnail)
                        <div class="relative h-72 sm:h-96 overflow-hidden">
                            <img src="{{ $featured->thumbnail }}" alt="{{ $featured->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/40 to-transparent"></div>
                            <div class="absolute bottom-0 left-0 right-0 p-6 sm:p-8 text-white">
                                <span class="inline-block px-3 py-1 bg-brand-600 text-white text-xs font-semibold rounded-full mb-3">
                                    FEATURED
                                </span>
                                <h2 class="text-2xl sm:text-3xl font-bold mb-3 line-clamp-2">
                                    <a href="{{ route('posts.show', $featured) }}">{{ $featured->title }}</a>
                                </h2>
                                <p class="text-blue-100 mb-4 line-clamp-2">{{ $featured->excerpt }}</p>
                                <div class="flex items-center space-x-4 text-sm">
                                    <span>{{ optional($featured->published_at)->format('M d, Y') }}</span>
                                    <span>•</span>
                                    <span>{{ $featured->reading_time }} min read</span>
                                    <span>•</span>
                                    <span>{{ number_format($featured->views) }} views</span>
                                </div>
                            </div>
                        </div>
                        @endif
                    </article>

                    <!-- Ad Slot After Featured -->
                    <div class="my-8">
                        <x-ad-slot position="after_featured" />
                    </div>

                    <!-- Post Grid -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        @foreach($posts->skip(1) as $index => $post)
                        <article class="bg-white dark:bg-gray-800 rounded-xl shadow hover:shadow-lg transition-all duration-300 overflow-hidden border border-gray-200 dark:border-gray-700 group">
                            @if($post->thumbnail)
                            <div class="h-48 overflow-hidden">
                                <img src="{{ $post->thumbnail }}" alt="{{ $post->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform">
                            </div>
                            @endif
                            <div class="p-5">
                                @if($post->category)
                                <span class="inline-block px-2 py-1 text-xs font-semibold bg-brand-100 dark:bg-brand-900/30 text-brand-700 dark:text-brand-300 rounded mb-2">
                                    {{ $post->category->name }}
                                </span>
                                @endif
                                <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-2 line-clamp-2 group-hover:text-brand-600 dark:group-hover:text-brand-400 transition-colors">
                                    <a href="{{ route('posts.show', $post) }}">{{ $post->title }}</a>
                                </h3>
                                <p class="text-gray-600 dark:text-gray-400 text-sm line-clamp-2 mb-3">{{ $post->excerpt }}</p>
                                <div class="flex items-center justify-between text-xs text-gray-500 dark:text-gray-400">
                                    <span>{{ optional($post->published_at)->format('M d') }}</span>
                                    <span>{{ $post->reading_time }} min</span>
                                </div>
                            </div>
                        </article>

                        <!-- Ad After Every 4 Posts -->
                        @if(($index + 1) % 4 === 0)
                        <div class="sm:col-span-2">
                            <x-ad-slot position="in_feed" />
                        </div>
                        @endif
                        @endforeach
                    </div>

                    <!-- Pagination -->
                    @if($posts->hasPages())
                    <div class="mt-8">
                        {{ $posts->links() }}
                    </div>
                    @endif

                    @endif
                </div>

                <!-- Sidebar -->
                <aside class="lg:col-span-4 space-y-8">
                    
                    <!-- Ad Slot -->
                    <div class="sticky top-24 space-y-8">
                        <x-ad-slot position="sidebar_top" />
                        
                        <!-- Newsletter -->
                        <div class="bg-gradient-to-br from-brand-600 to-accent-600 rounded-2xl p-6 text-white">
                            <h3 class="text-xl font-bold mb-2">Stay Updated</h3>
                            <p class="text-blue-100 text-sm mb-4">Get weekly tutorials delivered to your inbox</p>
                            <x-newsletter-form />
                        </div>

                        <!-- Popular Categories -->
                        <div class="bg-white dark:bg-gray-800 rounded-2xl p-6 border border-gray-200 dark:border-gray-700">
                            <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-4">Popular Topics</h3>
                            <div class="space-y-3">
                                @php
                                    $categories = \App\Models\Category::withCount('posts')
                                        ->orderByDesc('posts_count')
                                        ->take(6)
                                        ->get();
                                @endphp
                                @foreach($categories as $cat)
                                <a href="{{ route('categories.show', $cat) }}" class="flex items-center justify-between p-3 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors group">
                                    <div class="flex items-center space-x-3">
                                        <div class="w-10 h-10 bg-gradient-to-br from-brand-600 to-accent-600 rounded-lg flex items-center justify-center">
                                            <span class="text-white font-bold text-sm">{{ substr($cat->name, 0, 1) }}</span>
                                        </div>
                                        <span class="text-sm font-medium text-gray-900 dark:text-white group-hover:text-brand-600 dark:group-hover:text-brand-400">{{ $cat->name }}</span>
                                    </div>
                                    <span class="text-xs text-gray-500 dark:text-gray-400 bg-gray-100 dark:bg-gray-800 px-2 py-1 rounded-full">{{ $cat->posts_count }}</span>
                                </a>
                                @endforeach
                            </div>
                            <a href="{{ route('categories.index') }}" class="block mt-4 text-center text-sm font-medium text-brand-600 hover:text-brand-700 dark:text-brand-400">
                                View All Categories →
                            </a>
                        </div>

                        <!-- Ad Slot -->
                        <x-ad-slot position="sidebar_middle" />

                        <!-- Trending Posts -->
                        <div class="bg-white dark:bg-gray-800 rounded-2xl p-6 border border-gray-200 dark:border-gray-700">
                            <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-4 flex items-center">
                                <svg class="w-5 h-5 mr-2 text-red-500" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M12.395 2.553a1 1 0 00-1.45-.385c-.345.23-.614.558-.822.88-.214.33-.403.713-.57 1.116-.334.804-.614 1.768-.84 2.734a31.365 31.365 0 00-.613 3.58 2.64 2.64 0 01-.945-1.067c-.328-.68-.398-1.534-.398-2.654A1 1 0 005.05 6.05 6.981 6.981 0 003 11a7 7 0 1011.95-4.95c-.592-.591-.98-.985-1.348-1.467-.363-.476-.724-1.063-1.207-2.03zM12.12 15.12A3 3 0 017 13s.879.5 2.5.5c0-1 .5-4 1.25-4.5.5 1 .786 1.293 1.371 1.879A2.99 2.99 0 0113 13a2.99 2.99 0 01-.879 2.121z" clip-rule="evenodd"/>
                                </svg>
                                Trending
                            </h3>
                            <div class="space-y-4">
                                @php
                                    $trending = \App\Models\Post::where('status', 'published')
                                        ->orderByDesc('views')
                                        ->take(5)
                                        ->get();
                                @endphp
                                @foreach($trending as $index => $trend)
                                <a href="{{ route('posts.show', $trend) }}" class="flex gap-3 group">
                                    <span class="flex-shrink-0 w-6 h-6 bg-brand-600 text-white rounded-full flex items-center justify-center text-xs font-bold">
                                        {{ $index + 1 }}
                                    </span>
                                    <div class="flex-1 min-w-0">
                                        <h4 class="text-sm font-medium text-gray-900 dark:text-white line-clamp-2 group-hover:text-brand-600 dark:group-hover:text-brand-400">{{ $trend->title }}</h4>
                                        <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">{{ number_format($trend->views) }} views</p>
                                    </div>
                                </a>
                                @endforeach
                            </div>
                        </div>

                        <!-- Ad Slot -->
                        <x-ad-slot position="sidebar_bottom" />
                    </div>
                </aside>
            </div>

            <!-- Bottom Ad Slot -->
            <div class="mt-12">
                <x-ad-slot position="footer" />
            </div>

        </div>
    </div>
@endsection
