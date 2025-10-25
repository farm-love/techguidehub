@extends('layouts.app')

@section('title', config('app.name') . ' — Tech Tutorials, Reviews & Developer Tools')

@section('meta')
    <x-seo-meta 
        :title="config('app.name') . ' — Tech Tutorials, Reviews & Developer Tools'"
        description="Discover cutting-edge tech tutorials, honest software reviews, and powerful developer tools to accelerate your learning and boost productivity."
        :url="url('/')"
        type="website"
    />
@endsection

@section('content')
<!-- Hero Section with Gradient Background -->
<div class="relative overflow-hidden bg-gradient-to-br from-brand-600 via-brand-700 to-accent-700 dark:from-brand-900 dark:via-brand-950 dark:to-accent-900">
    <!-- Animated Background Pattern -->
    <div class="absolute inset-0 opacity-10">
        <div class="absolute inset-0" style="background-image: radial-gradient(circle at 2px 2px, white 1px, transparent 0); background-size: 40px 40px;"></div>
    </div>
    
    <!-- Floating Orbs -->
    <div class="absolute top-20 left-10 w-72 h-72 bg-accent-400 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-pulse-slow"></div>
    <div class="absolute bottom-20 right-10 w-96 h-96 bg-brand-400 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-pulse-slow" style="animation-delay: 2s;"></div>
    
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20 sm:py-28 lg:py-36">
        <div class="text-center animate-fade-in-up">
            <!-- Badge -->
            <div class="inline-flex items-center px-4 py-2 rounded-full bg-white/10 backdrop-blur-sm border border-white/20 text-white mb-8 animate-fade-in">
                <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                </svg>
                <span class="text-sm font-medium">Welcome to TechVerse Hub</span>
            </div>

            <!-- Main Heading -->
            <h1 class="text-4xl sm:text-5xl lg:text-7xl font-extrabold text-white leading-tight mb-6">
                Master Tech Skills with
                <span class="block text-transparent bg-clip-text bg-gradient-to-r from-blue-200 via-purple-200 to-pink-200 mt-2">
                    Expert Tutorials & Tools
                </span>
            </h1>

            <!-- Subheading -->
            <p class="max-w-3xl mx-auto text-lg sm:text-xl lg:text-2xl text-blue-100 mb-10 leading-relaxed">
                Dive into cutting-edge tutorials, discover powerful developer tools, and stay ahead with honest tech reviews — all in one place.
            </p>

            <!-- CTA Buttons -->
            <div class="flex flex-col sm:flex-row gap-4 justify-center items-center mb-12">
                <a href="{{ route('home') }}" class="group inline-flex items-center px-8 py-4 bg-white text-brand-600 font-bold rounded-xl hover:bg-blue-50 transition-all duration-200 hover:scale-105 hover:shadow-2xl">
                    <span>Explore Tutorials</span>
                    <svg class="ml-2 w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                    </svg>
                </a>
                <a href="{{ route('categories.index') }}" class="inline-flex items-center px-8 py-4 border-2 border-white/30 backdrop-blur-sm text-white font-bold rounded-xl hover:bg-white/10 hover:border-white/50 transition-all duration-200">
                    <svg class="mr-2 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path>
                    </svg>
                    Browse Categories
                </a>
            </div>

            <!-- Stats -->
            <div class="grid grid-cols-2 md:grid-cols-4 gap-6 max-w-4xl mx-auto">
                @php
                    $stats = [
                        'posts' => \App\Models\Post::where('status', 'published')->count(),
                        'categories' => \App\Models\Category::count(),
                        'tools' => \App\Models\Tool::count(),
                        'subscribers' => \App\Models\Subscriber::count(),
                    ];
                @endphp
                <div class="bg-white/10 backdrop-blur-sm rounded-xl p-4 border border-white/20">
                    <div class="text-3xl font-bold text-white">{{ $stats['posts'] }}+</div>
                    <div class="text-blue-100 text-sm">Tutorials</div>
                </div>
                <div class="bg-white/10 backdrop-blur-sm rounded-xl p-4 border border-white/20">
                    <div class="text-3xl font-bold text-white">{{ $stats['categories'] }}+</div>
                    <div class="text-blue-100 text-sm">Categories</div>
                </div>
                <div class="bg-white/10 backdrop-blur-sm rounded-xl p-4 border border-white/20">
                    <div class="text-3xl font-bold text-white">{{ $stats['tools'] }}+</div>
                    <div class="text-blue-100 text-sm">Tools</div>
                </div>
                <div class="bg-white/10 backdrop-blur-sm rounded-xl p-4 border border-white/20">
                    <div class="text-3xl font-bold text-white">{{ $stats['subscribers'] }}+</div>
                    <div class="text-blue-100 text-sm">Subscribers</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Wave Divider -->
    <div class="absolute bottom-0 left-0 right-0">
        <svg class="w-full h-16 sm:h-24 fill-current text-gray-50 dark:text-gray-900" viewBox="0 0 1440 120" xmlns="http://www.w3.org/2000/svg">
            <path d="M0,64L48,69.3C96,75,192,85,288,80C384,75,480,53,576,48C672,43,768,53,864,58.7C960,64,1056,64,1152,58.7C1248,53,1344,43,1392,37.3L1440,32L1440,120L1392,120C1344,120,1248,120,1152,120C1056,120,960,120,864,120C768,120,672,120,576,120C480,120,384,120,288,120C192,120,96,120,48,120L0,120Z"></path>
        </svg>
    </div>
</div>

<!-- Featured Content Section -->
<div class="bg-gray-50 dark:bg-gray-900 py-16 sm:py-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Section Header -->
        <div class="text-center mb-12 animate-fade-in-up">
            <h2 class="text-3xl sm:text-4xl font-bold text-gray-900 dark:text-white mb-4">
                Latest Tutorials & Guides
            </h2>
            <p class="text-lg text-gray-600 dark:text-gray-300 max-w-2xl mx-auto">
                Stay updated with the freshest content from our expert contributors
            </p>
        </div>

        @php
            $featuredPosts = \App\Models\Post::where('status', 'published')
                ->with(['category', 'user'])
                ->orderByDesc('published_at')
                ->take(6)
                ->get();
        @endphp

        @if($featuredPosts->count() > 0)
        <!-- Featured Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($featuredPosts as $post)
            <article class="group bg-white dark:bg-gray-800 rounded-2xl shadow-lg overflow-hidden hover:shadow-2xl transition-all duration-300 hover:-translate-y-2 border border-gray-200 dark:border-gray-700">
                @if($post->thumbnail)
                <div class="relative h-48 overflow-hidden">
                    <img src="{{ $post->thumbnail }}" alt="{{ $post->title }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                    @if($post->category)
                    <span class="absolute top-4 left-4 px-3 py-1 bg-brand-600 text-white text-xs font-semibold rounded-full">
                        {{ $post->category->name }}
                    </span>
                    @endif
                </div>
                @endif
                <div class="p-6">
                    <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-3 line-clamp-2 group-hover:text-brand-600 dark:group-hover:text-brand-400 transition-colors">
                        <a href="{{ route('posts.show', $post) }}">{{ $post->title }}</a>
                    </h3>
                    <p class="text-gray-600 dark:text-gray-300 text-sm line-clamp-3 mb-4">
                        {{ $post->excerpt }}
                    </p>
                    <div class="flex items-center justify-between pt-4 border-t border-gray-200 dark:border-gray-700">
                        <div class="flex items-center space-x-3">
                            <div class="w-8 h-8 bg-gradient-to-r from-brand-500 to-accent-500 rounded-full flex items-center justify-center">
                                <span class="text-white font-semibold text-xs">{{ substr($post->user?->name ?? 'A', 0, 1) }}</span>
                            </div>
                            <div class="text-xs text-gray-500 dark:text-gray-400">
                                <div class="font-medium text-gray-700 dark:text-gray-300">{{ $post->user?->name ?? 'Anonymous' }}</div>
                                <div>{{ optional($post->published_at)->format('M d, Y') }}</div>
                            </div>
                        </div>
                        <span class="text-xs text-gray-500 dark:text-gray-400">{{ $post->reading_time }} min read</span>
                    </div>
                </div>
            </article>
            @endforeach
        </div>

        <div class="text-center mt-12">
            <a href="{{ route('home') }}" class="inline-flex items-center px-6 py-3 bg-brand-600 hover:bg-brand-700 text-white font-semibold rounded-xl transition-all duration-200 hover:scale-105">
                View All Posts
                <svg class="ml-2 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                </svg>
            </a>
        </div>
        @else
        <div class="text-center py-12">
            <svg class="mx-auto h-16 w-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
            </svg>
            <p class="mt-4 text-gray-600 dark:text-gray-400">No posts yet. Check back soon!</p>
        </div>
        @endif
    </div>
</div>

<!-- Categories Section -->
<div class="bg-white dark:bg-gray-800 py-16 sm:py-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-3xl sm:text-4xl font-bold text-gray-900 dark:text-white mb-4">
                Explore by Category
            </h2>
            <p class="text-lg text-gray-600 dark:text-gray-300">
                Find exactly what you're looking for
            </p>
        </div>

        @php
            $topCategories = \App\Models\Category::withCount('posts')
                ->orderByDesc('posts_count')
                ->take(8)
                ->get();
        @endphp

        <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
            @foreach($topCategories as $category)
            <a href="{{ route('categories.show', $category) }}" class="group relative bg-gradient-to-br from-brand-50 to-accent-50 dark:from-brand-900/20 dark:to-accent-900/20 rounded-2xl p-6 hover:shadow-xl transition-all duration-300 hover:-translate-y-1 border border-brand-100 dark:border-brand-800">
                <div class="flex flex-col items-center text-center">
                    <div class="w-16 h-16 bg-gradient-to-br from-brand-600 to-accent-600 rounded-2xl flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
                        <span class="text-2xl font-bold text-white">{{ substr($category->name, 0, 1) }}</span>
                    </div>
                    <h3 class="font-bold text-gray-900 dark:text-white mb-2 group-hover:text-brand-600 dark:group-hover:text-brand-400 transition-colors">
                        {{ $category->name }}
                    </h3>
                    <p class="text-sm text-gray-600 dark:text-gray-400">{{ $category->posts_count }} articles</p>
                </div>
            </a>
            @endforeach
        </div>
    </div>
</div>

<!-- Tools Section -->
@if(\App\Models\Tool::count() > 0)
<div class="bg-gray-50 dark:bg-gray-900 py-16 sm:py-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-3xl sm:text-4xl font-bold text-gray-900 dark:text-white mb-4">
                Recommended Developer Tools
            </h2>
            <p class="text-lg text-gray-600 dark:text-gray-300">
                Handpicked tools to boost your productivity
            </p>
        </div>

        @php
            $topTools = \App\Models\Tool::orderByDesc('rating')->take(4)->get();
        @endphp

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach($topTools as $tool)
            <a href="{{ route('tools.show', $tool) }}" class="group bg-white dark:bg-gray-800 rounded-2xl p-6 hover:shadow-xl transition-all duration-300 hover:-translate-y-1 border border-gray-200 dark:border-gray-700">
                @if($tool->image)
                <img src="{{ $tool->image }}" alt="{{ $tool->name }}" class="w-16 h-16 object-cover rounded-xl mb-4">
                @endif
                <h3 class="font-bold text-gray-900 dark:text-white mb-2 group-hover:text-brand-600 dark:group-hover:text-brand-400 transition-colors">
                    {{ $tool->name }}
                </h3>
                <div class="flex items-center mb-2">
                    @for($i = 0; $i < 5; $i++)
                        <svg class="w-4 h-4 {{ $i < $tool->rating ? 'text-yellow-400' : 'text-gray-300' }}" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                        </svg>
                    @endfor
                </div>
                <p class="text-sm text-gray-600 dark:text-gray-400 line-clamp-2">{{ $tool->description }}</p>
            </a>
            @endforeach
        </div>

        <div class="text-center mt-12">
            <a href="{{ route('tools.index') }}" class="inline-flex items-center px-6 py-3 bg-brand-600 hover:bg-brand-700 text-white font-semibold rounded-xl transition-all duration-200 hover:scale-105">
                Explore All Tools
                <svg class="ml-2 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                </svg>
            </a>
        </div>
    </div>
</div>
@endif

<!-- Newsletter CTA Section -->
<div class="bg-gradient-to-r from-brand-600 to-accent-600 dark:from-brand-800 dark:to-accent-800 py-16">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <div class="inline-flex items-center justify-center w-16 h-16 bg-white/20 rounded-full mb-6">
            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
            </svg>
        </div>
        <h2 class="text-3xl sm:text-4xl font-bold text-white mb-4">
            Never Miss an Update
        </h2>
        <p class="text-xl text-blue-100 mb-8 max-w-2xl mx-auto">
            Get the latest tutorials, tool reviews, and tech insights delivered straight to your inbox every week.
        </p>
        <div class="max-w-md mx-auto">
            <x-newsletter-form />
        </div>
        <p class="mt-4 text-sm text-blue-100">
            Join {{ \App\Models\Subscriber::count() }}+ developers already subscribed. Unsubscribe anytime.
        </p>
    </div>
</div>
@endsection
