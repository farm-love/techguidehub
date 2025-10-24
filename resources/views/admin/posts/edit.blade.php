@extends('layouts.admin')

@section('title', 'Edit Post')

@section('admin-content')
    <div class="space-y-6">
        <div class="flex justify-between items-center">
            <div>
                <h1 class="text-3xl font-bold text-gray-900 dark:text-gray-100">Edit Post</h1>
                <p class="text-gray-600 dark:text-gray-300">Update post content and settings</p>
            </div>
            <a href="{{ route('admin.posts.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-600 text-white text-sm font-medium rounded-md hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2">
                Back to Posts
            </a>
        </div>

        <form method="POST" action="{{ route('admin.posts.update', $post) }}">
            @csrf
            @method('PATCH')
            <div class="bg-white dark:bg-gray-800 shadow-sm rounded-lg border border-gray-200 dark:border-gray-700 p-6 space-y-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Title</label>
                    <input name="title" value="{{ $post->title }}" class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md bg-white dark:bg-gray-900 text-gray-900 dark:text-gray-100" required />
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Slug</label>
                    <input name="slug" value="{{ $post->slug }}" class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md bg-white dark:bg-gray-900 text-gray-900 dark:text-gray-100" required />
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Excerpt</label>
                    <textarea name="excerpt" class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md bg-white dark:bg-gray-900 text-gray-900 dark:text-gray-100">{{ $post->excerpt }}</textarea>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Content (HTML)</label>
                    <textarea name="content" class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md bg-white dark:bg-gray-900 text-gray-900 dark:text-gray-100" rows="10" required>{{ $post->content }}</textarea>
                </div>
                <div class="flex gap-2">
                    <button class="px-4 py-2 bg-blue-600 text-white rounded-md">Save</button>
                    <a href="{{ route('admin.posts.index') }}" class="px-4 py-2 border rounded-md">Cancel</a>
                </div>
            </div>
        </form>
    </div>
@endsection
