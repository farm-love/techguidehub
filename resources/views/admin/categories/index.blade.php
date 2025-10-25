@extends('layouts.admin')

@section('admin-content')
<div class="space-y-6">
    <!-- Header -->
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
        <div>
            <h1 class="text-3xl font-bold bg-gradient-to-r from-brand-600 to-accent-600 bg-clip-text text-transparent">Categories</h1>
            <p class="text-gray-600 dark:text-gray-300 mt-1">Organize your content into topics</p>
        </div>
        <a href="{{ route('admin.categories.create') }}" class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-brand-600 to-accent-600 hover:from-brand-700 hover:to-accent-700 text-white text-sm font-medium rounded-lg shadow-lg hover:shadow-xl transition-all duration-300 hover:scale-105">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
            </svg>
            New Category
        </a>
    </div>

    <!-- Success/Error Messages -->
    @if(session('success'))
    <div class="bg-green-50 dark:bg-green-900/30 border border-green-200 dark:border-green-700 rounded-xl p-4 flex items-center space-x-3">
        <svg class="h-5 w-5 text-green-500 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
        </svg>
        <p class="text-sm font-medium text-green-800 dark:text-green-100">{{ session('success') }}</p>
    </div>
    @endif

    @if(session('error'))
    <div class="bg-red-50 dark:bg-red-900/30 border border-red-200 dark:border-red-700 rounded-xl p-4 flex items-center space-x-3">
        <svg class="h-5 w-5 text-red-500 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
        </svg>
        <p class="text-sm font-medium text-red-800 dark:text-red-100">{{ session('error') }}</p>
    </div>
    @endif

    <!-- Categories Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($categories as $category)
        <div class="group bg-white dark:bg-gray-800 rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 border border-gray-200 dark:border-gray-700 overflow-hidden hover:border-brand-500 dark:hover:border-brand-500">
            <div class="p-6">
                <div class="flex items-start justify-between mb-4">
                    <div class="flex items-center space-x-3">
                        <div class="w-12 h-12 bg-gradient-to-br from-brand-600 to-accent-600 rounded-xl flex items-center justify-center shadow-lg group-hover:scale-110 transition-transform">
                            <span class="text-white font-bold text-lg">{{ substr($category->name, 0, 1) }}</span>
                        </div>
                        <div>
                            <h3 class="text-lg font-bold text-gray-900 dark:text-white group-hover:text-brand-600 dark:group-hover:text-brand-400 transition-colors">
                                {{ $category->name }}
                            </h3>
                            <p class="text-sm text-gray-500 dark:text-gray-400">{{ $category->posts_count }} posts</p>
                        </div>
                    </div>
                </div>

                @if($category->description)
                <p class="text-sm text-gray-600 dark:text-gray-400 mb-4 line-clamp-3">{{ $category->description }}</p>
                @endif

                <div class="flex flex-wrap gap-2 mb-4">
                    <span class="inline-flex items-center px-2 py-1 bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300 rounded-lg text-xs">
                        <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 20l4-16m2 16l4-16M6 9h14M4 15h14"/>
                        </svg>
                        {{ $category->slug }}
                    </span>
                    @if($category->order !== null)
                    <span class="inline-flex items-center px-2 py-1 bg-brand-100 dark:bg-brand-900/30 text-brand-700 dark:text-brand-300 rounded-lg text-xs font-medium">
                        Order: {{ $category->order }}
                    </span>
                    @endif
                </div>

                <div class="flex items-center justify-between pt-4 border-t border-gray-200 dark:border-gray-700">
                    <a href="{{ route('categories.show', $category) }}" target="_blank" class="inline-flex items-center text-brand-600 dark:text-brand-400 hover:text-brand-700 dark:hover:text-brand-300 text-sm font-medium">
                        View Posts
                        <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                        </svg>
                    </a>
                    <div class="flex items-center space-x-2">
                        <a href="{{ route('admin.categories.edit', $category) }}" class="p-2 text-gray-400 hover:text-brand-600 dark:hover:text-brand-400 hover:bg-brand-50 dark:hover:bg-brand-900/20 rounded-lg transition-colors">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                            </svg>
                        </a>
                        <form action="{{ route('admin.categories.destroy', $category) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this category?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="p-2 text-gray-400 hover:text-red-600 dark:hover:text-red-400 hover:bg-red-50 dark:hover:bg-red-900/20 rounded-lg transition-colors">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                </svg>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @empty
        <div class="col-span-full bg-white dark:bg-gray-800 rounded-2xl shadow-lg border border-gray-200 dark:border-gray-700 p-12">
            <div class="text-center">
                <svg class="mx-auto h-16 w-16 text-gray-400 dark:text-gray-500 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                </svg>
                <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-2">No categories found</h3>
                <p class="text-gray-500 dark:text-gray-400 mb-6">Get started by creating your first category.</p>
                <a href="{{ route('admin.categories.create') }}" class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-brand-600 to-accent-600 hover:from-brand-700 hover:to-accent-700 text-white rounded-lg font-medium shadow-lg hover:shadow-xl transition-all duration-300 hover:scale-105">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                    Create Your First Category
                </a>
            </div>
        </div>
        @endforelse
    </div>

    <!-- Pagination -->
    @if($categories->hasPages())
    <div class="flex justify-center">
        {{ $categories->links() }}
    </div>
    @endif
</div>
@endsection
