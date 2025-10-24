@extends('layouts.app')

@section('title', 'Edit Post')

@section('content')
    <div class="max-w-3xl mx-auto py-8 px-4">
        <h1 class="text-2xl font-bold mb-4">Edit Post</h1>
        <form method="POST" action="{{ route('admin.posts.update', $post) }}">
            @csrf
            @method('PATCH')
            <div class="mb-3">
                <label class="block mb-1">Title</label>
                <input name="title" value="{{ $post->title }}" class="input input-bordered w-full" required />
            </div>
            <div class="mb-3">
                <label class="block mb-1">Slug</label>
                <input name="slug" value="{{ $post->slug }}" class="input input-bordered w-full" required />
            </div>
            <div class="mb-3">
                <label class="block mb-1">Excerpt</label>
                <textarea name="excerpt" class="textarea textarea-bordered w-full">{{ $post->excerpt }}</textarea>
            </div>
            <div class="mb-3">
                <label class="block mb-1">Content (HTML)</label>
                <textarea name="content" class="textarea textarea-bordered w-full" rows="10" required>{{ $post->content }}</textarea>
            </div>
            <div class="flex gap-2">
                <button class="btn btn-primary">Save</button>
                <a href="{{ route('admin.posts.index') }}" class="btn">Cancel</a>
            </div>
        </form>
    </div>
@endsection
