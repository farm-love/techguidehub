@extends('layouts.admin')

@section('admin-content')
<div class="space-y-6">
    <!-- Header -->
    <div class="flex justify-between items-center">
        <div>
            <h1 class="text-3xl font-bold text-gray-900">Tags</h1>
            <p class="text-gray-600">Manage blog tags</p>
        </div>
        <a href="{{ route('admin.tags.create') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
            </svg>
            New Tag
        </a>
    </div>

    <!-- Success Message -->
    @if(session('success'))
    <div class="bg-green-50 border border-green-200 rounded-md p-4">
        <div class="flex">
            <div class="flex-shrink-0">
                <svg class="h-5 w-5 text-green-400" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                </svg>
            </div>
            <div class="ml-3">
                <p class="text-sm font-medium text-green-800">{{ session('success') }}</p>
            </div>
        </div>
    </div>
    @endif

    <!-- Tags Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4">
        @forelse($tags as $tag)
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-4 hover:shadow-md transition-shadow">
            <div class="flex items-start justify-between mb-3">
                <div class="flex items-center space-x-2">
                    <div class="w-8 h-8 bg-gradient-to-r from-green-500 to-blue-500 rounded-lg flex items-center justify-center">
                        <span class="text-white font-semibold text-xs">#</span>
                    </div>
                    <div>
                        <h3 class="text-sm font-semibold text-gray-900">{{ $tag->name }}</h3>
                        <p class="text-xs text-gray-500">{{ $tag->posts_count }} posts</p>
                    </div>
                </div>
            </div>
            
            @if($tag->description)
                <p class="text-xs text-gray-600 mb-3">{{ Str::limit($tag->description, 60) }}</p>
            @endif
            
            <div class="flex items-center justify-between">
                <span class="text-xs text-gray-500">Slug: {{ $tag->slug }}</span>
                <div class="flex items-center space-x-1">
                    <a href="{{ route('admin.tags.edit', $tag) }}" class="text-indigo-600 hover:text-indigo-800">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                        </svg>
                    </a>
                    <form action="{{ route('admin.tags.destroy', $tag) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this tag?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-600 hover:text-red-800">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                            </svg>
                        </button>
                    </form>
                </div>
            </div>
        </div>
        @empty
        <div class="col-span-full text-center py-12">
            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
            </svg>
            <h3 class="mt-2 text-sm font-medium text-gray-900">No tags</h3>
            <p class="mt-1 text-sm text-gray-500">Get started by creating a new tag.</p>
            <div class="mt-6">
                <a href="{{ route('admin.tags.create') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-md hover:bg-blue-700">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                    New Tag
                </a>
            </div>
        </div>
        @endforelse
    </div>

    <!-- Pagination -->
    @if($tags->hasPages())
    <div class="flex justify-center">
        {{ $tags->links() }}
    </div>
    @endif
</div>
@endsection
