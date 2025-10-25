@extends('layouts.app')

@section('title', 'Developer Tools & Resources — ' . config('app.name'))

@section('meta')
    <x-seo-meta 
        title="Developer Tools & Resources — {{ config('app.name') }}"
        description="Discover the best developer tools, productivity apps, and resources. Handpicked and reviewed by experts."
        :url="route('tools.index')"
        type="website"
    />
@endsection

@section('content')
<!-- Hero Section -->
<div class="relative bg-gradient-to-br from-brand-600 via-purple-600 to-accent-600 dark:from-brand-900 dark:via-purple-900 dark:to-accent-900 py-16 sm:py-20">
    <div class="absolute inset-0 opacity-10">
        <div class="absolute inset-0" style="background-image: radial-gradient(circle at 2px 2px, white 1px, transparent 0); background-size: 30px 30px;"></div>
    </div>
    
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <div class="inline-flex items-center px-4 py-2 rounded-full bg-white/10 backdrop-blur-sm border border-white/20 text-white mb-6">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path>
            </svg>
            <span class="text-sm font-medium">Productivity Boost</span>
        </div>
        
        <h1 class="text-4xl sm:text-5xl lg:text-6xl font-extrabold text-white leading-tight mb-6">
            Developer <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-200 to-pink-200">Tools & Resources</span>
        </h1>
        
        <p class="max-w-2xl mx-auto text-lg sm:text-xl text-blue-100 leading-relaxed">
            Carefully curated tools to supercharge your development workflow. From code editors to deployment platforms.
        </p>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 sm:py-16">
    <!-- Filter/Sort Bar (placeholder for future enhancement) -->
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-8">
        <div>
            <h2 class="text-2xl font-bold text-gray-900 dark:text-white">All Tools</h2>
            <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">{{ $tools->total() }} tools available</p>
        </div>
        
        <!-- Future: Add sorting and filtering options here -->
    </div>

    <!-- Tools Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 sm:gap-8">
        @foreach($tools as $tool)
        <a href="{{ route('tools.show', $tool) }}" 
           class="group bg-white dark:bg-gray-800 rounded-2xl shadow-md hover:shadow-2xl transition-all duration-300 hover:-translate-y-2 border border-gray-200 dark:border-gray-700 overflow-hidden">
            <!-- Tool Image/Icon -->
            <div class="relative h-48 bg-gradient-to-br from-brand-100 to-accent-100 dark:from-brand-900/30 dark:to-accent-900/30 flex items-center justify-center overflow-hidden">
                @if($tool->image)
                    <img src="{{ $tool->image }}" alt="{{ $tool->name }}" class="w-24 h-24 object-cover rounded-2xl shadow-lg group-hover:scale-110 transition-transform duration-300">
                @else
                    <div class="w-24 h-24 bg-gradient-to-br from-brand-600 to-accent-600 rounded-2xl flex items-center justify-center shadow-lg group-hover:scale-110 group-hover:rotate-3 transition-transform duration-300">
                        <span class="text-4xl font-bold text-white">{{ substr($tool->name, 0, 1) }}</span>
                    </div>
                @endif
                
                <!-- Category Badge -->
                @if($tool->category)
                <span class="absolute top-4 right-4 px-3 py-1 bg-white/90 dark:bg-gray-800/90 backdrop-blur-sm text-xs font-semibold text-gray-700 dark:text-gray-300 rounded-full">
                    {{ $tool->category }}
                </span>
                @endif
            </div>
            
            <!-- Tool Content -->
            <div class="p-6">
                <!-- Tool Name -->
                <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-2 group-hover:text-brand-600 dark:group-hover:text-brand-400 transition-colors">
                    {{ $tool->name }}
                </h3>
                
                <!-- Rating Stars -->
                <div class="flex items-center mb-3">
                    @for($i = 0; $i < 5; $i++)
                        <svg class="w-5 h-5 {{ $i < $tool->rating ? 'text-yellow-400' : 'text-gray-300 dark:text-gray-600' }}" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                        </svg>
                    @endfor
                    <span class="ml-2 text-sm font-semibold text-gray-700 dark:text-gray-300">{{ number_format($tool->rating, 1) }}</span>
                </div>
                
                <!-- Description -->
                <p class="text-sm text-gray-600 dark:text-gray-400 line-clamp-3 mb-4">
                    {{ $tool->description }}
                </p>
                
                <!-- Tags/Features (if available) -->
                @if($tool->tags && is_array($tool->tags))
                <div class="flex flex-wrap gap-2 mb-4">
                    @foreach(array_slice($tool->tags, 0, 3) as $tag)
                    <span class="px-2 py-1 bg-gray-100 dark:bg-gray-700 text-xs text-gray-700 dark:text-gray-300 rounded-md">
                        {{ $tag }}
                    </span>
                    @endforeach
                </div>
                @endif
                
                <!-- CTA -->
                <div class="flex items-center justify-between pt-4 border-t border-gray-200 dark:border-gray-700">
                    <span class="text-sm font-semibold text-brand-600 dark:text-brand-400">Learn More</span>
                    <svg class="w-5 h-5 text-brand-600 dark:text-brand-400 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                    </svg>
                </div>
            </div>
        </a>
        @endforeach
    </div>

    <!-- Pagination -->
    @if($tools->hasPages())
    <div class="mt-12">
        {{ $tools->links() }}
    </div>
    @endif

    <!-- Empty State -->
    @if($tools->isEmpty())
    <div class="text-center py-16">
        <div class="inline-flex items-center justify-center w-20 h-20 bg-gray-100 dark:bg-gray-800 rounded-full mb-6">
            <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path>
            </svg>
        </div>
        <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-2">No Tools Yet</h3>
        <p class="text-gray-600 dark:text-gray-400 mb-6">Check back soon for awesome developer tools!</p>
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


