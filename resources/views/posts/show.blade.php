@extends('layouts.app')

@section('title', ($post->meta_title ?: $post->title) . ' — ' . config('app.name'))
@section('meta')
    <x-seo-meta 
        :title="($post->meta_title ?: $post->title) . ' — ' . config('app.name')"
        :description="($post->meta_description ?: Str::limit(strip_tags($post->excerpt ?: $post->content), 160))"
        :url="route('posts.show', $post)"
        :image="$post->thumbnail"
        type="article"
        :schema="$post->schema_json"
        :canonical="$post->canonical_url"
    />
@endsection

@section('content')
    <div class="max-w-4xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
        <x-breadcrumbs :items="[['label' => 'Posts', 'url' => route('home')], ['label' => $post->title]]" />
        <x-ad-slot position="in_article_top" />
        <article>
            <h1 class="text-3xl font-bold mb-2 text-gray-900 dark:text-gray-50">{{ $post->title }}</h1>
            <p class="text-sm text-gray-600 dark:text-gray-400 mb-6">Published {{ optional($post->published_at)->format('M d, Y') }} • {{ $post->reading_time }} min read</p>
            @if($post->thumbnail)
                <img src="{{ $post->thumbnail }}" alt="{{ $post->title }}" class="rounded mb-6 w-full">
            @endif
            <div class="prose dark:prose-invert max-w-none">{!! $post->content !!}</div>
        </article>
        <div class="my-8">
            <x-ad-slot position="in_article_middle" />
        </div>
        @if($related->isNotEmpty())
            <section class="mt-10">
                <h2 class="text-xl font-semibold mb-4">Related Posts</h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    @foreach($related as $rel)
                        <a class="block p-4 border rounded hover:shadow" href="{{ route('posts.show', $rel) }}">
                            <h3 class="font-semibold">{{ $rel->title }}</h3>
                            <p class="text-sm text-gray-500">{{ optional($rel->published_at)->format('M d, Y') }}</p>
                        </a>
                    @endforeach
                </div>
            </section>
        @endif
            @if($post->user)
            <aside class="mt-12 p-4 border rounded bg-white dark:bg-gray-800">
                <div class="flex items-center gap-4">
                    @if($post->user->avatar)
                        <img src="{{ $post->user->avatar }}" class="w-14 h-14 rounded-full object-cover" />
                    @endif
                    <div>
                        <div class="font-semibold">{{ $post->user->name }}</div>
                        @if($post->user->bio)
                            <div class="text-sm text-gray-600">{{ $post->user->bio }}</div>
                        @endif
                        <div class="text-sm mt-1 space-x-3">
                            @if($post->user->twitter)<a class="text-blue-600 dark:text-blue-400" href="{{ $post->user->twitter }}" target="_blank">Twitter</a>@endif
                            @if($post->user->github)<a class="text-gray-900 dark:text-gray-200" href="{{ $post->user->github }}" target="_blank">GitHub</a>@endif
                            @if($post->user->website)<a class="text-green-700 dark:text-green-400" href="{{ $post->user->website }}" target="_blank">Website</a>@endif
                        </div>
                    </div>
                </div>
            </aside>
        @endif
        <div class="mt-8">
            <x-ad-slot position="in_article_bottom" />
        </div>
    </div>
@endsection


