@extends('layouts.app')

@section('title', ($post->meta_title ?: $post->title) . ' — ' . config('app.name'))
@section('meta')
    @php
        // Build enhanced Article schema if none exists
        $articleSchema = $post->schema_json ?: [
            '@context' => 'https://schema.org',
            '@type' => 'Article',
            'mainEntityOfPage' => ['@type' => 'WebPage', '@id' => route('posts.show', $post)],
            'headline' => $post->meta_title ?: $post->title,
            'description' => $post->meta_description ?: Str::limit(strip_tags($post->excerpt ?: $post->content), 160),
            'image' => $post->thumbnail ? [$post->thumbnail] : [],
            'author' => [
                '@type' => 'Person',
                'name' => optional($post->user)->name ?: config('app.name')
            ],
            'publisher' => [
                '@type' => 'Organization',
                'name' => config('app.name'),
                'logo' => ['@type' => 'ImageObject', 'url' => asset('images/logo.png')]
            ],
            'datePublished' => optional($post->published_at)->toIso8601String(),
            'dateModified' => optional($post->updated_at ?? $post->published_at)->toIso8601String(),
        ];
    @endphp

    <x-seo-meta 
        :title="($post->meta_title ?: $post->title) . ' — ' . config('app.name')"
        :description="($post->meta_description ?: Str::limit(strip_tags($post->excerpt ?: $post->content), 160))"
        :url="route('posts.show', $post)"
        :image="$post->thumbnail"
        type="article"
        :schema="$articleSchema"
        :canonical="$post->canonical_url"
    />
    {{-- Breadcrumb schema --}}
    <script type="application/ld+json">
        {!! json_encode([
            '@context' => 'https://schema.org',
            '@type' => 'BreadcrumbList',
            'itemListElement' => [
                ['@type' => 'ListItem', 'position' => 1, 'name' => 'Home', 'item' => url('/')],
                ['@type' => 'ListItem', 'position' => 2, 'name' => 'Posts', 'item' => route('home')],
                ['@type' => 'ListItem', 'position' => 3, 'name' => $post->title, 'item' => route('posts.show', $post)],
            ]
        ]) !!}
    </script>
@endsection

@section('content')
    <div class="max-w-5xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
        <x-breadcrumbs :items="[['label' => 'Posts', 'url' => route('home')], ['label' => $post->title]]" />

        <div class="lg:flex lg:items-start lg:space-x-8">
            <main class="lg:flex-1">
                <article>
                    <div class="mb-4">
                        <h1 class="text-3xl md:text-4xl font-extrabold mb-2 text-gray-900 dark:text-gray-50">{{ $post->title }}</h1>
                        <div class="flex items-center space-x-3 text-sm text-gray-600 dark:text-gray-400">
                            <div>By <a href="#" class="font-medium text-gray-800 dark:text-gray-200">{{ optional($post->user)->name ?? config('app.name') }}</a></div>
                            <div>•</div>
                            <div>Published {{ optional($post->published_at)->format('M d, Y') }}</div>
                            @if($post->updated_at && $post->updated_at->gt($post->published_at))
                                <div>•</div>
                                <div>Updated {{ $post->updated_at->format('M d, Y') }}</div>
                            @endif
                            <div>•</div>
                            <div>{{ $post->reading_time }} min read</div>
                        </div>

                        {{-- Sponsored / Affiliate badge --}}
                        @if($post->is_sponsored ?? $post->tags->contains(fn($t)=>strtolower($t->name) === 'affiliate' || strtolower($t->name) === 'sponsored'))
                            <div class="mt-2 inline-flex items-center rounded-full px-2 py-1 text-xs bg-gray-100 dark:bg-gray-700 text-gray-800 dark:text-gray-200">Sponsored</div>
                        @endif

                        {{-- AI disclosure if the post indicates AI generation (flexible checks) --}}
                        @if($post->is_ai_generated ?? $post->ai_generated ?? data_get($post, 'schema_json.isAI'))
                            <div class="mt-3 text-xs text-yellow-700 dark:text-yellow-300 bg-yellow-50 dark:bg-yellow-900/20 p-2 rounded">This post was generated or assisted by AI. We review AI content for accuracy — please report issues via the contact page.</div>
                        @endif
                    </div>

                    @if($post->thumbnail)
                        <img src="{{ $post->thumbnail }}" alt="{{ $post->title }}" loading="lazy" class="rounded mb-6 w-full object-cover">
                    @endif

                    {{-- Move top ad further down to avoid excessive ads above the fold. Keep a mid-article ad slot. --}}

                    <div class="prose dark:prose-invert max-w-none" id="post-content">{!! $post->content !!}</div>

                    <div class="mt-8">
                        <x-ad-slot position="in_article_middle" />
                    </div>
                </article>

                {{-- Social share buttons --}}
                <div class="mt-6 flex items-center space-x-3">
                    @php $postUrl = route('posts.show', $post); $postTitle = urlencode($post->title); $postText = urlencode(strip_tags(Str::limit($post->excerpt ?: $post->content, 120))); @endphp
                    <a href="https://twitter.com/intent/tweet?text={{ $postTitle }}&url={{ urlencode($postUrl) }}" target="_blank" class="text-sm px-3 py-2 rounded bg-blue-50 text-blue-600 hover:bg-blue-100">Share on Twitter</a>
                    <a href="https://www.linkedin.com/shareArticle?mini=true&url={{ urlencode($postUrl) }}&title={{ $postTitle }}" target="_blank" class="text-sm px-3 py-2 rounded bg-sky-50 text-sky-700 hover:bg-sky-100">Share on LinkedIn</a>
                    <a href="https://www.reddit.com/submit?url={{ urlencode($postUrl) }}&title={{ $postTitle }}" target="_blank" class="text-sm px-3 py-2 rounded bg-amber-50 text-amber-700 hover:bg-amber-100">Share on Reddit</a>
                </div>

                {{-- Sticky newsletter CTA at end of post --}}
                <div class="mt-12">
                    <div class="p-6 bg-white dark:bg-gray-800 border rounded shadow-sm">
                        <h3 class="text-lg font-semibold mb-2">Stay updated — join our newsletter</h3>
                        <p class="text-sm text-gray-600 dark:text-gray-400 mb-4">Get the latest tutorials and tools delivered weekly.</p>
                        <x-newsletter-form />
                    </div>
                </div>

                <div class="my-8">
                    <x-ad-slot position="in_article_bottom" />
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
            </main>

            {{-- Right column: Table of contents + author box (sticky on desktop) --}}
            <aside class="hidden lg:block w-72 shrink-0">
                <div class="sticky top-24">
                    <div id="toc" class="mb-6 p-4 bg-white dark:bg-gray-800 border rounded">
                        <h3 class="font-semibold mb-2">Contents</h3>
                        <nav id="toc-list" class="text-sm text-gray-700 dark:text-gray-300"></nav>
                    </div>

                    <div class="p-4 bg-white dark:bg-gray-800 border rounded">
                        <div class="flex items-center gap-4">
                            @if($post->user && $post->user->avatar)
                                <img src="{{ $post->user->avatar }}" class="w-12 h-12 rounded-full object-cover" alt="{{ $post->user->name }}">
                            @endif
                            <div>
                                <div class="font-semibold">{{ optional($post->user)->name ?? config('app.name') }}</div>
                                @if(optional($post->user)->bio)
                                    <div class="text-sm text-gray-600 dark:text-gray-400">{{ $post->user->bio }}</div>
                                @endif
                            </div>
                        </div>

                        @if($post->tags->isNotEmpty())
                            <div class="mt-3 flex flex-wrap gap-2">
                                @foreach($post->tags as $tag)
                                    <span class="text-xs px-2 py-1 rounded bg-gray-100 dark:bg-gray-700">{{ $tag->name }}</span>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>
            </aside>
        </div>
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


