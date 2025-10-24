@extends('layouts.app')

@section('title', 'Categories — ' . config('app.name'))

@section('content')
    <div class="max-w-5xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
        <h1 class="text-2xl font-bold mb-6">Categories</h1>
        <ul class="grid grid-cols-2 md:grid-cols-3 gap-4">
            @foreach($categories as $category)
                <li>
                    <a href="{{ route('categories.show', $category) }}" class="block p-4 border rounded hover:shadow">
                        <div class="font-semibold">{{ $category->name }}</div>
                        <div class="text-sm text-gray-500">{{ $category->posts_count }} posts</div>
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
@endsection


