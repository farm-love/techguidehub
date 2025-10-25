@extends('layouts.app')

@section('title', $category->name . ' — ' . config('app.name'))
@section('meta')
    <x-seo-meta 
        :title="$category->name . ' — ' . config('app.name')"
        description="Explore the best posts in {{ $category->name }} at {{ config('app.name') }}"
        url="{{ url()->current() }}"
        type="website"
        canonical="{{ url()->current() }}"
    />
@endsection

@section('content')
    <!-- Hero Section -->
    <div class="bg-gradient-to-br from-brand-600 to-accent-600 dark:from-brand-900 dark:to-accent-900">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
            <x-breadcrumbs :items="[['label' => 'Categories', 'url' => route('categories.index')], ['label' => $category->name]]" class="mb-6" />
            
            <div class="flex items-center space-x-4 mb-6">
                <div class="w-16 h-16 bg-white/20 backdrop-blur rounded-2xl flex items-center justify-center">
                    <span class="text-white text-3xl font-bold">{{ substr($category->name, 0, 1) }}</span>
                </div>
                <div>
                    <h1 class="text-4xl lg:text-5xl font-extrabold text-white">{{ $category->name }}</h1>
                    <p class="text-blue-100 mt-2">{{ $posts->total() }} {{ Str::plural('article', $posts->total()) }}</p>
                </div>
            </div>
            
        @if($category->description)
            <p class="text-lg text-blue-100 max-w-3xl">{{ $category->description }}</p>
            @endif
        </div>
    </div>

    <div class="bg-gray-50 dark:bg-gray-900">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            
            <!-- Top Ad Slot -->
            <div class="mb-8">
                <x-ad-slot position="category_top" />
            </div>

            <!-- Main Grid -->
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
                
                <!-- Posts Grid -->
                <div class="lg:col-span-8">
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        @forelse($posts as $index => $post)
                        <article class="group bg-white dark:bg-gray-800 rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 overflow-hidden border border-gray-200 dark:border-gray-700">
                            @if($post->thumbnail)
                            <div class="relative h-48 overflow-hidden">
                                <img src="{{ $post->thumbnail }}" alt="{{ $post->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                                <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent"></div>
                            </div>
                            @endif
                            
                            <div class="p-6">
                                <h2 class="text-lg font-bold text-gray-900 dark:text-white mb-2 line-clamp-2 group-hover:text-brand-600 dark:group-hover:text-brand-400 transition-colors">
                                    <a href="{{ route('posts.show', $post) }}">{{ $post->title }}</a>
                                </h2>
                                
                                <p class="text-sm text-gray-600 dark:text-gray-400 line-clamp-3 mb-4">{{ $post->excerpt }}</p>
                                
                                <div class="flex items-center justify-between text-xs text-gray-500 dark:text-gray-400">
                                    <div class="flex items-center space-x-2">
                                        @if($post->user)
                                        <span>{{ $post->user->name }}</span>
                                        <span>•</span>
                                        @endif
                                        <span>{{ optional($post->published_at)->format('M d, Y') }}</span>
                                    </div>
                                    <div class="flex items-center space-x-1">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                        </svg>
                                        <span>{{ number_format($post->views) }}</span>
                                    </div>
                                </div>
                            </div>
                        </article>

                        <!-- Ad After Every 4 Posts -->
                        @if(($index + 1) % 4 === 0)
                        <div class="sm:col-span-2">
                            <x-ad-slot position="in_category_feed" />
                        </div>
                        @endif
                        @empty
                        <div class="sm:col-span-2 bg-white dark:bg-gray-800 rounded-2xl shadow-lg border border-gray-200 dark:border-gray-700 p-12">
                            <div class="text-center">
                                <svg class="mx-auto h-16 w-16 text-gray-400 dark:text-gray-500 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                </svg>
                                <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-2">No posts yet</h3>
                                <p class="text-gray-500 dark:text-gray-400">Check back soon for new content in this category.</p>
                            </div>
                        </div>
                        @endforelse
                    </div>

                    <!-- Pagination -->
                    @if($posts->hasPages())
                    <div class="mt-8">
                        {{ $posts->links() }}
                    </div>
        @endif
                </div>

                <!-- Sidebar -->
                <aside class="lg:col-span-4 space-y-6">
                    <div class="sticky top-24 space-y-6">
                        <!-- Ad Slot -->
                        <x-ad-slot position="category_sidebar_top" />
                        
                        <!-- Related Categories -->
                        <div class="bg-white dark:bg-gray-800 rounded-2xl p-6 shadow-lg border border-gray-200 dark:border-gray-700">
                            <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-4">Related Topics</h3>
                            <div class="space-y-3">
                                @php
                                    $relatedCategories = \App\Models\Category::where('id', '!=', $category->id)
                                        ->withCount('posts')
                                        ->orderByDesc('posts_count')
                                        ->take(5)
                                        ->get();
                                @endphp
                                @foreach($relatedCategories as $cat)
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
                        </div>

                        <!-- Newsletter -->
                        <div class="bg-gradient-to-br from-brand-600 to-accent-600 rounded-2xl p-6 text-white">
                            <h3 class="text-xl font-bold mb-2">Stay Updated</h3>
                            <p class="text-blue-100 text-sm mb-4">Get the latest {{ $category->name }} articles delivered to your inbox</p>
                            <x-newsletter-form />
                        </div>

                        <!-- Ad Slot -->
                        <x-ad-slot position="category_sidebar_bottom" />

                        <!-- Popular Posts -->
                        <div class="bg-white dark:bg-gray-800 rounded-2xl p-6 shadow-lg border border-gray-200 dark:border-gray-700">
                            <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-4 flex items-center">
                                <svg class="w-5 h-5 mr-2 text-brand-600" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M12.395 2.553a1 1 0 00-1.45-.385c-.345.23-.614.558-.822.88-.214.33-.403.713-.57 1.116-.334.804-.614 1.768-.84 2.734a31.365 31.365 0 00-.613 3.58 2.64 2.64 0 01-.945-1.067c-.328-.68-.398-1.534-.398-2.654A1 1 0 005.05 6.05 6.981 6.981 0 003 11a7 7 0 1011.95-4.95c-.592-.591-.98-.985-1.348-1.467-.363-.476-.724-1.063-1.207-2.03zM12.12 15.12A3 3 0 017 13s.879.5 2.5.5c0-1 .5-4 1.25-4.5.5 1 .786 1.293 1.371 1.879A2.99 2.99 0 0113 13a2.99 2.99 0 01-.879 2.121z" clip-rule="evenodd"/>
                                </svg>
                                Popular in {{ $category->name }}
                            </h3>
                            <div class="space-y-4">
                                @php
                                    $popularPosts = \App\Models\Post::where('status', 'published')
                                        ->where('category_id', $category->id)
                                        ->orderByDesc('views')
                                        ->take(5)
                                        ->get();
                                @endphp
                                @foreach($popularPosts as $index => $popular)
                                <a href="{{ route('posts.show', $popular) }}" class="flex gap-3 group">
                                    <span class="flex-shrink-0 w-6 h-6 bg-gradient-to-br from-brand-600 to-accent-600 text-white rounded-full flex items-center justify-center text-xs font-bold">
                                        {{ $index + 1 }}
                                    </span>
                                    <div class="flex-1 min-w-0">
                                        <h4 class="text-sm font-medium text-gray-900 dark:text-white line-clamp-2 group-hover:text-brand-600 dark:group-hover:text-brand-400">{{ $popular->title }}</h4>
                                        <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">{{ number_format($popular->views) }} views</p>
                                    </div>
                                </a>
            @endforeach
                            </div>
                        </div>
                    </div>
                </aside>
            </div>

            <!-- Bottom Ad Slot -->
            <div class="mt-12">
                <x-ad-slot position="category_bottom" />
            </div>
        </div>
    </div>
@endsection
