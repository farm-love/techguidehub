@extends('layouts.app')

@section('title', 'Browse Categories — ' . config('app.name'))

@section('meta')
    <x-seo-meta 
        title="Browse Categories — {{ config('app.name') }}"
        description="Explore all tutorial categories on {{ config('app.name') }}. Find the perfect topic for your learning journey."
        :url="route('categories.index')"
        type="website"
    />
@endsection

@section('content')
<!-- Hero Section -->
<div class="relative bg-gradient-to-br from-brand-600 via-brand-700 to-accent-600 dark:from-brand-900 dark:via-brand-800 dark:to-accent-900 py-16 sm:py-20">
    <div class="absolute inset-0 opacity-10">
        <div class="absolute inset-0" style="background-image: radial-gradient(circle at 2px 2px, white 1px, transparent 0); background-size: 30px 30px;"></div>
    </div>
    
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <div class="inline-flex items-center px-4 py-2 rounded-full bg-white/10 backdrop-blur-sm border border-white/20 text-white mb-6">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
            </svg>
            <span class="text-sm font-medium">Explore Topics</span>
        </div>
        
        <h1 class="text-4xl sm:text-5xl lg:text-6xl font-extrabold text-white leading-tight mb-6">
            Browse <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-200 to-purple-200">All Categories</span>
        </h1>
        
        <p class="max-w-2xl mx-auto text-lg sm:text-xl text-blue-100 leading-relaxed">
            Discover tutorials organized by topic. Find exactly what you need to level up your skills.
        </p>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 sm:py-16">
    <!-- Stats Bar -->
    <div class="grid grid-cols-2 md:grid-cols-4 gap-6 mb-12">
        <div class="bg-white dark:bg-gray-800 rounded-xl p-6 shadow-md border border-gray-200 dark:border-gray-700 text-center">
            <div class="text-3xl font-bold text-brand-600 dark:text-brand-400">{{ $categories->count() }}</div>
            <div class="text-sm text-gray-600 dark:text-gray-400 mt-1">Categories</div>
        </div>
        <div class="bg-white dark:bg-gray-800 rounded-xl p-6 shadow-md border border-gray-200 dark:border-gray-700 text-center">
            <div class="text-3xl font-bold text-accent-600 dark:text-accent-400">{{ $categories->sum('posts_count') }}</div>
            <div class="text-sm text-gray-600 dark:text-gray-400 mt-1">Total Articles</div>
        </div>
        <div class="bg-white dark:bg-gray-800 rounded-xl p-6 shadow-md border border-gray-200 dark:border-gray-700 text-center">
            <div class="text-3xl font-bold text-green-600 dark:text-green-400">{{ $categories->where('posts_count', '>', 0)->count() }}</div>
            <div class="text-sm text-gray-600 dark:text-gray-400 mt-1">Active Topics</div>
        </div>
        <div class="bg-white dark:bg-gray-800 rounded-xl p-6 shadow-md border border-gray-200 dark:border-gray-700 text-center">
            <div class="text-3xl font-bold text-purple-600 dark:text-purple-400">∞</div>
            <div class="text-sm text-gray-600 dark:text-gray-400 mt-1">More to Come</div>
        </div>
    </div>

    <!-- Categories Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
        @foreach($categories as $category)
        <a href="{{ route('categories.show', $category) }}" 
           class="group relative bg-white dark:bg-gray-800 rounded-2xl p-6 hover:shadow-2xl transition-all duration-300 hover:-translate-y-2 border border-gray-200 dark:border-gray-700 overflow-hidden">
            <!-- Gradient Background -->
            <div class="absolute inset-0 bg-gradient-to-br from-brand-50 to-accent-50 dark:from-brand-900/20 dark:to-accent-900/20 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
            
            <!-- Content -->
            <div class="relative z-10">
                <!-- Icon -->
                <div class="w-16 h-16 bg-gradient-to-br from-brand-600 to-accent-600 rounded-2xl flex items-center justify-center mb-4 group-hover:scale-110 group-hover:rotate-3 transition-transform duration-300 shadow-lg">
                    <span class="text-2xl font-bold text-white">{{ substr($category->name, 0, 1) }}</span>
                </div>
                
                <!-- Title -->
                <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-2 group-hover:text-brand-600 dark:group-hover:text-brand-400 transition-colors">
                    {{ $category->name }}
                </h3>
                
                <!-- Description (if available) -->
                @if($category->description)
                <p class="text-sm text-gray-600 dark:text-gray-400 mb-4 line-clamp-2">
                    {{ $category->description }}
                </p>
                @endif
                
                <!-- Stats -->
                <div class="flex items-center justify-between pt-4 border-t border-gray-200 dark:border-gray-700">
                    <div class="flex items-center space-x-1">
                        <svg class="w-5 h-5 text-brand-600 dark:text-brand-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                        <span class="text-sm font-semibold text-gray-900 dark:text-gray-100">{{ $category->posts_count }}</span>
                        <span class="text-xs text-gray-500 dark:text-gray-400">{{ Str::plural('article', $category->posts_count) }}</span>
                    </div>
                    
                    <!-- Arrow -->
                    <svg class="w-5 h-5 text-gray-400 group-hover:text-brand-600 dark:group-hover:text-brand-400 group-hover:translate-x-1 transition-all" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                    </svg>
                </div>
            </div>
            
            <!-- Hover Effect Dot Pattern -->
            <div class="absolute -right-8 -bottom-8 w-32 h-32 opacity-10 group-hover:opacity-20 transition-opacity">
                <div class="w-full h-full" style="background-image: radial-gradient(circle, currentColor 1px, transparent 1px); background-size: 8px 8px;"></div>
            </div>
        </a>
        @endforeach
    </div>

    <!-- Empty State -->
    @if($categories->isEmpty())
    <div class="text-center py-16">
        <div class="inline-flex items-center justify-center w-20 h-20 bg-gray-100 dark:bg-gray-800 rounded-full mb-6">
            <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
            </svg>
        </div>
        <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-2">No Categories Yet</h3>
        <p class="text-gray-600 dark:text-gray-400 mb-6">Check back soon for new content categories!</p>
        <a href="{{ route('home') }}" class="inline-flex items-center px-6 py-3 bg-brand-600 hover:bg-brand-700 text-white font-semibold rounded-xl transition-all duration-200 hover:scale-105">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
            Back to Home
        </a>
    </div>
    @endif
</div>
@endsection


