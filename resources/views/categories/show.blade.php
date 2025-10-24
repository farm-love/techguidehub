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
    <div class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
        <x-breadcrumbs :items="[['label' => 'Categories', 'url' => route('categories.index')], ['label' => $category->name]]" />
        <h1 class="text-2xl font-bold mb-6">{{ $category->name }}</h1>
        @if($category->description)
            <p class="text-gray-700 mb-6">{{ $category->description }}</p>
        @endif
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @foreach($posts as $post)
                <article class="border rounded-lg p-4 hover:shadow">
                    <a href="{{ route('posts.show', $post) }}" class="block">
                        <h2 class="text-xl font-semibold">{{ $post->title }}</h2>
                        <p class="text-sm text-gray-500">{{ optional($post->published_at)->format('M d, Y') }}</p>
                        <p class="mt-2 text-gray-700">{{ $post->excerpt }}</p>
                    </a>
                </article>
            @endforeach
        </div>
        <div class="mt-6">{{ $posts->links() }}</div>
    </div>
@endsection


