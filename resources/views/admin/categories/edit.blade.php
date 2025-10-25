@extends('layouts.admin')

@section('admin-content')
<div class="max-w-3xl">
    <!-- Header -->
    <div class="mb-8">
        <div class="flex items-center space-x-4 mb-4">
            <a href="{{ route('admin.categories.index') }}" class="p-2 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg transition-colors">
                <svg class="w-5 h-5 text-gray-600 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
            </a>
            <div>
                <h1 class="text-3xl font-bold text-gray-900 dark:text-gray-100">Edit Category</h1>
                <p class="text-gray-600 dark:text-gray-300">Update category information</p>
            </div>
        </div>
    </div>

    <!-- Form Card -->
    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg border border-gray-200 dark:border-gray-700 overflow-hidden">
        <form action="{{ route('admin.categories.update', $category) }}" method="POST" class="p-8 space-y-6">
            @csrf
            @method('PUT')

            <!-- Name -->
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                    Category Name <span class="text-red-500">*</span>
                </label>
                <input type="text" name="name" id="name" value="{{ old('name', $category->name) }}" required
                    class="w-full px-4 py-3 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-brand-500 focus:border-transparent transition-colors @error('name') border-red-500 @enderror">
                @error('name')
                    <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                @enderror
            </div>

            <!-- Slug -->
            <div>
                <label for="slug" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                    Slug (URL-friendly name)
                </label>
                <input type="text" name="slug" id="slug" value="{{ old('slug', $category->slug) }}"
                    class="w-full px-4 py-3 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-brand-500 focus:border-transparent transition-colors @error('slug') border-red-500 @enderror">
                @error('slug')
                    <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                @enderror
                <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">Leave empty to auto-generate from name</p>
            </div>

            <!-- Description -->
            <div>
                <label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                    Description
                </label>
                <textarea name="description" id="description" rows="4"
                    class="w-full px-4 py-3 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-brand-500 focus:border-transparent transition-colors @error('description') border-red-500 @enderror">{{ old('description', $category->description) }}</textarea>
                @error('description')
                    <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                @enderror
            </div>

            <!-- Parent Category -->
            <div>
                <label for="parent_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                    Parent Category
                </label>
                <select name="parent_id" id="parent_id"
                    class="w-full px-4 py-3 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-brand-500 focus:border-transparent transition-colors @error('parent_id') border-red-500 @enderror">
                    <option value="">None (Top Level)</option>
                    @foreach($parentCategories as $parent)
                        <option value="{{ $parent->id }}" {{ old('parent_id', $category->parent_id) == $parent->id ? 'selected' : '' }}>
                            {{ $parent->name }}
                        </option>
                    @endforeach
                </select>
                @error('parent_id')
                    <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                @enderror
            </div>

            <!-- Order -->
            <div>
                <label for="order" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                    Display Order
                </label>
                <input type="number" name="order" id="order" min="0" value="{{ old('order', $category->order ?? 0) }}"
                    class="w-full px-4 py-3 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-brand-500 focus:border-transparent transition-colors @error('order') border-red-500 @enderror">
                @error('order')
                    <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                @enderror
                <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">Lower numbers appear first</p>
            </div>

            <!-- Category Stats -->
            <div class="bg-gray-50 dark:bg-gray-700/50 rounded-lg p-4 space-y-2 text-sm">
                <div class="flex justify-between">
                    <span class="text-gray-600 dark:text-gray-400">Category ID:</span>
                    <span class="font-medium text-gray-900 dark:text-gray-100">{{ $category->id }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-600 dark:text-gray-400">Total Posts:</span>
                    <span class="font-medium text-gray-900 dark:text-gray-100">{{ $category->posts()->count() }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-600 dark:text-gray-400">Created:</span>
                    <span class="font-medium text-gray-900 dark:text-gray-100">{{ $category->created_at->format('M d, Y') }}</span>
                </div>
            </div>

            <!-- Actions -->
            <div class="flex items-center justify-end space-x-4 pt-6 border-t border-gray-200 dark:border-gray-700">
                <a href="{{ route('admin.categories.index') }}" class="px-6 py-3 text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg font-medium transition-colors">
                    Cancel
                </a>
                <button type="submit" class="px-6 py-3 bg-gradient-to-r from-brand-600 to-accent-600 hover:from-brand-700 hover:to-accent-700 text-white rounded-lg font-medium transition-all hover:scale-105 shadow-lg">
                    Update Category
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

