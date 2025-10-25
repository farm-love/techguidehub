@extends('layouts.app')

@section('title', ($post->meta_title ?: $post->title) . ' — ' . config('app.name'))
@section('meta')
    @php
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
    <div class="bg-gray-50 dark:bg-gray-900 min-h-screen">
        <!-- Hero Header -->
        <div class="bg-gradient-to-br from-brand-600 to-accent-600 dark:from-brand-900 dark:to-accent-900 py-8">
            <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
                <x-breadcrumbs :items="[['label' => 'Posts', 'url' => route('home')], ['label' => $post->title]]" class="mb-6" />
                
                <!-- Category Badge -->
                @if($post->category)
                <a href="{{ route('categories.show', $post->category) }}" class="inline-block mb-4 px-3 py-1 bg-white/20 hover:bg-white/30 text-white text-sm font-semibold rounded-full transition-colors">
                    {{ $post->category->name }}
                </a>
                @endif

                <!-- Title -->
                <h1 class="text-3xl md:text-4xl lg:text-5xl font-extrabold mb-4 text-white leading-tight">{{ $post->title }}</h1>
                
                <!-- Meta Info -->
                <div class="flex flex-wrap items-center gap-4 text-sm text-blue-100">
                    <div class="flex items-center space-x-2">
                        @if(optional($post->user)->avatar)
                        <img src="{{ $post->user->avatar }}" alt="{{ $post->user->name }}" class="w-8 h-8 rounded-full">
                        @endif
                        <span class="font-medium text-white">{{ optional($post->user)->name ?? config('app.name') }}</span>
                    </div>
                    <span>•</span>
                    <span>{{ optional($post->published_at)->format('M d, Y') }}</span>
                    @if($post->updated_at && $post->updated_at->gt($post->published_at))
                        <span>•</span>
                        <span>Updated {{ $post->updated_at->format('M d, Y') }}</span>
                    @endif
                    <span>•</span>
                    <span>{{ $post->reading_time }} min read</span>
                    <span>•</span>
                    <span>{{ number_format($post->views) }} views</span>
                </div>

                <!-- Badges -->
                <div class="flex flex-wrap gap-2 mt-4">
                    @if($post->is_sponsored ?? $post->tags->contains(fn($t)=>strtolower($t->name) === 'affiliate' || strtolower($t->name) === 'sponsored'))
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-amber-500/20 text-amber-100 backdrop-blur">
                        <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                        </svg>
                        Sponsored
                    </span>
                    @endif
                    
                    @if($post->is_ai_generated ?? $post->ai_generated ?? data_get($post, 'schema_json.isAI'))
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-purple-500/20 text-purple-100 backdrop-blur">
                        <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M13 7H7v6h6V7z"/>
                            <path fill-rule="evenodd" d="M7 2a1 1 0 012 0v1h2V2a1 1 0 112 0v1h2a2 2 0 012 2v2h1a1 1 0 110 2h-1v2h1a1 1 0 110 2h-1v2a2 2 0 01-2 2h-2v1a1 1 0 11-2 0v-1H9v1a1 1 0 11-2 0v-1H5a2 2 0 01-2-2v-2H2a1 1 0 110-2h1V9H2a1 1 0 010-2h1V5a2 2 0 012-2h2V2z" clip-rule="evenodd"/>
                        </svg>
                        AI-Assisted
                    </span>
                    @endif
                </div>
            </div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <!-- Top Ad -->
            <div class="mb-8">
                <x-ad-slot position="article_top" />
            </div>

            <div class="lg:grid lg:grid-cols-12 lg:gap-8">
                <!-- Main Content -->
                <main class="lg:col-span-8">
                    <article class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg border border-gray-200 dark:border-gray-700 overflow-hidden">
                        <!-- Featured Image -->
                        @if($post->thumbnail)
                        <div class="relative h-[400px] overflow-hidden">
                            <img src="{{ $post->thumbnail }}" alt="{{ $post->title }}" class="w-full h-full object-cover">
                        </div>
                        @endif

                        <!-- Action Buttons -->
                        <div class="p-6 pb-0 sm:px-8 lg:px-10">
                            <div class="flex flex-wrap gap-3 justify-between items-center pb-6 border-b border-gray-200 dark:border-gray-700">
                                <div class="flex gap-3">
                                    <button class="bookmark-btn no-print" data-post-id="{{ $post->id }}">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z"/>
                                        </svg>
                                        <span>Bookmark</span>
                                    </button>
                                    <button class="print-btn inline-flex items-center gap-2 px-4 py-2 rounded-lg bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300 hover:bg-gray-200 dark:hover:bg-gray-600 border border-gray-300 dark:border-gray-600 transition-colors text-sm font-medium no-print">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/>
                                        </svg>
                                        <span>Print</span>
                                    </button>
                                </div>
                                <div class="text-sm text-gray-600 dark:text-gray-400">
                                    <span class="font-semibold">{{ number_format($post->views) }}</span> views
                                </div>
                            </div>
                        </div>

                        <!-- Content -->
                        <div class="p-6 pt-6 sm:p-8 sm:pt-6 lg:p-10 lg:pt-6">
                            <div class="prose prose-lg dark:prose-invert max-w-none prose-headings:font-bold prose-headings:text-gray-900 dark:prose-headings:text-white prose-a:text-brand-600 dark:prose-a:text-brand-400 prose-img:rounded-lg prose-code:bg-gray-100 dark:prose-code:bg-gray-800 prose-pre:bg-gray-900 dark:prose-pre:bg-gray-950 line-numbers" id="post-content">
                                {!! $post->content !!}
                            </div>

                            <!-- Mid-Article Ad -->
                            <div class="my-10">
                                <x-ad-slot position="in_article_middle" />
                            </div>

                            <!-- Tags -->
                            @if($post->tags->isNotEmpty())
                            <div class="mt-10 pt-6 border-t border-gray-200 dark:border-gray-700">
                                <h3 class="text-sm font-semibold text-gray-700 dark:text-gray-300 mb-3">Tags:</h3>
                                <div class="flex flex-wrap gap-2">
                                    @foreach($post->tags as $tag)
                                    <a href="#" class="px-3 py-1.5 bg-gray-100 dark:bg-gray-700 hover:bg-brand-100 dark:hover:bg-brand-900/30 text-gray-700 dark:text-gray-300 hover:text-brand-700 dark:hover:text-brand-300 rounded-full text-sm font-medium transition-colors">
                                        #{{ $tag->name }}
                                    </a>
                                    @endforeach
                                </div>
                            </div>
                            @endif

                            <!-- Social Share -->
                            <div class="mt-8 pt-6 border-t border-gray-200 dark:border-gray-700">
                                <h3 class="text-sm font-semibold text-gray-700 dark:text-gray-300 mb-3">Share this article:</h3>
                                @php 
                                    $postUrl = route('posts.show', $post); 
                                    $postTitle = urlencode($post->title); 
                                @endphp
                                <div class="flex flex-wrap gap-3">
                                    <a href="https://twitter.com/intent/tweet?text={{ $postTitle }}&url={{ urlencode($postUrl) }}" target="_blank" class="inline-flex items-center px-4 py-2 bg-blue-500 hover:bg-blue-600 text-white rounded-lg font-medium transition-colors">
                                        <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 24 24"><path d="M8.29 20.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0022 5.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.072 4.072 0 012.8 9.713v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 012 18.407a11.616 11.616 0 006.29 1.84"/></svg>
                                        Twitter
                                    </a>
                                    <a href="https://www.linkedin.com/shareArticle?mini=true&url={{ urlencode($postUrl) }}&title={{ $postTitle }}" target="_blank" class="inline-flex items-center px-4 py-2 bg-sky-600 hover:bg-sky-700 text-white rounded-lg font-medium transition-colors">
                                        <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 24 24"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/></svg>
                                        LinkedIn
                                    </a>
                                    <a href="https://www.reddit.com/submit?url={{ urlencode($postUrl) }}&title={{ $postTitle }}" target="_blank" class="inline-flex items-center px-4 py-2 bg-orange-600 hover:bg-orange-700 text-white rounded-lg font-medium transition-colors">
                                        <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 24 24"><path d="M12 0A12 12 0 0 0 0 12a12 12 0 0 0 12 12 12 12 0 0 0 12-12A12 12 0 0 0 12 0zm5.01 4.744c.688 0 1.25.561 1.25 1.249a1.25 1.25 0 0 1-2.498.056l-2.597-.547-.8 3.747c1.824.07 3.48.632 4.674 1.488.308-.309.73-.491 1.207-.491.968 0 1.754.786 1.754 1.754 0 .716-.435 1.333-1.01 1.614a3.111 3.111 0 0 1 .042.52c0 2.694-3.13 4.87-7.004 4.87-3.874 0-7.004-2.176-7.004-4.87 0-.183.015-.366.043-.534A1.748 1.748 0 0 1 4.028 12c0-.968.786-1.754 1.754-1.754.463 0 .898.196 1.207.49 1.207-.883 2.878-1.43 4.744-1.487l.885-4.182a.342.342 0 0 1 .14-.197.35.35 0 0 1 .238-.042l2.906.617a1.214 1.214 0 0 1 1.108-.701zM9.25 12C8.561 12 8 12.562 8 13.25c0 .687.561 1.248 1.25 1.248.687 0 1.248-.561 1.248-1.249 0-.688-.561-1.249-1.249-1.249zm5.5 0c-.687 0-1.248.561-1.248 1.25 0 .687.561 1.248 1.249 1.248.688 0 1.249-.561 1.249-1.249 0-.687-.562-1.249-1.25-1.249zm-5.466 3.99a.327.327 0 0 0-.231.094.33.33 0 0 0 0 .463c.842.842 2.484.913 2.961.913.477 0 2.105-.056 2.961-.913a.361.361 0 0 0 .029-.463.33.33 0 0 0-.464 0c-.547.533-1.684.73-2.512.73-.828 0-1.979-.196-2.512-.73a.326.326 0 0 0-.232-.095z"/></svg>
                                        Reddit
                                    </a>
                                    <button onclick="navigator.clipboard.writeText('{{ $postUrl }}'); alert('Link copied!')" class="inline-flex items-center px-4 py-2 bg-gray-600 hover:bg-gray-700 text-white rounded-lg font-medium transition-colors">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"/>
                                        </svg>
                                        Copy Link
                                    </button>
                                </div>
                            </div>
                        </div>
                    </article>

                    <!-- Author Info -->
                    @if($post->user)
                    <div class="mt-8 bg-gradient-to-br from-brand-50 to-accent-50 dark:from-gray-800 dark:to-gray-800 rounded-2xl p-6 border border-brand-200 dark:border-gray-700">
                        <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-4">About the Author</h3>
                        <div class="flex items-start gap-4">
                            @if($post->user->avatar)
                            <img src="{{ $post->user->avatar }}" alt="{{ $post->user->name }}" class="w-16 h-16 rounded-full object-cover flex-shrink-0">
                            @else
                            <div class="w-16 h-16 rounded-full bg-gradient-to-br from-brand-600 to-accent-600 flex items-center justify-center flex-shrink-0">
                                <span class="text-white text-2xl font-bold">{{ substr($post->user->name, 0, 1) }}</span>
                            </div>
                            @endif
                            <div class="flex-1">
                                <div class="font-bold text-gray-900 dark:text-white text-lg">{{ $post->user->name }}</div>
                                @if($post->user->bio)
                                <p class="text-gray-600 dark:text-gray-300 mt-2">{{ $post->user->bio }}</p>
                                @endif
                                @if($post->user->twitter || $post->user->github || $post->user->website)
                                <div class="flex flex-wrap gap-3 mt-3">
                                    @if($post->user->twitter)
                                    <a href="{{ $post->user->twitter }}" target="_blank" class="text-blue-600 dark:text-blue-400 hover:text-blue-700 dark:hover:text-blue-300 text-sm font-medium">Twitter</a>
                                    @endif
                                    @if($post->user->github)
                                    <a href="{{ $post->user->github }}" target="_blank" class="text-gray-900 dark:text-gray-200 hover:text-gray-700 dark:hover:text-gray-400 text-sm font-medium">GitHub</a>
                                    @endif
                                    @if($post->user->website)
                                    <a href="{{ $post->user->website }}" target="_blank" class="text-green-700 dark:text-green-400 hover:text-green-800 dark:hover:text-green-300 text-sm font-medium">Website</a>
                                    @endif
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    @endif

                    <!-- Newsletter CTA -->
                    <div class="mt-8 bg-gradient-to-br from-brand-600 to-accent-600 rounded-2xl p-8 text-center text-white">
                        <h3 class="text-2xl font-bold mb-2">Never Miss an Update</h3>
                        <p class="text-blue-100 mb-6">Get the latest tutorials, tips, and tools delivered to your inbox</p>
                        <x-newsletter-form />
                    </div>

                    <!-- Bottom Article Ad -->
                    <div class="mt-8">
                        <x-ad-slot position="in_article_bottom" />
                    </div>

                    <!-- Related Posts -->
                    @if($related->isNotEmpty())
                    <section class="mt-10">
                        <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-6">Continue Reading</h2>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            @foreach($related as $rel)
                            <a href="{{ route('posts.show', $rel) }}" class="group bg-white dark:bg-gray-800 rounded-xl overflow-hidden shadow hover:shadow-lg transition-all border border-gray-200 dark:border-gray-700">
                                @if($rel->thumbnail)
                                <div class="h-40 overflow-hidden">
                                    <img src="{{ $rel->thumbnail }}" alt="{{ $rel->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform">
                                </div>
                                @endif
                                <div class="p-4">
                                    <h3 class="font-bold text-gray-900 dark:text-white line-clamp-2 group-hover:text-brand-600 dark:group-hover:text-brand-400 transition-colors">{{ $rel->title }}</h3>
                                    <p class="text-sm text-gray-500 dark:text-gray-400 mt-2">{{ optional($rel->published_at)->format('M d, Y') }} • {{ $rel->reading_time }} min</p>
                                </div>
                            </a>
                            @endforeach
                        </div>
                    </section>
                    @endif

                    <!-- Comments Section -->
                    <x-comments-section :post="$post" />
                </main>

                <!-- Sidebar -->
                <aside class="lg:col-span-4 space-y-6 mt-8 lg:mt-0">
                    <div class="sticky top-24 space-y-6">
                        <!-- Table of Contents -->
                        <div id="toc" class="bg-white dark:bg-gray-800 rounded-2xl p-6 border border-gray-200 dark:border-gray-700">
                            <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-4">Contents</h3>
                            <nav id="toc-list" class="space-y-2 text-sm text-gray-700 dark:text-gray-300"></nav>
                        </div>

                        <!-- Sidebar Ad -->
                        <x-ad-slot position="sidebar_top" />

                        <!-- Popular Posts -->
                        <div class="bg-white dark:bg-gray-800 rounded-2xl p-6 border border-gray-200 dark:border-gray-700">
                            <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-4 flex items-center">
                                <svg class="w-5 h-5 mr-2 text-brand-600" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M12.395 2.553a1 1 0 00-1.45-.385c-.345.23-.614.558-.822.88-.214.33-.403.713-.57 1.116-.334.804-.614 1.768-.84 2.734a31.365 31.365 0 00-.613 3.58 2.64 2.64 0 01-.945-1.067c-.328-.68-.398-1.534-.398-2.654A1 1 0 005.05 6.05 6.981 6.981 0 003 11a7 7 0 1011.95-4.95c-.592-.591-.98-.985-1.348-1.467-.363-.476-.724-1.063-1.207-2.03zM12.12 15.12A3 3 0 017 13s.879.5 2.5.5c0-1 .5-4 1.25-4.5.5 1 .786 1.293 1.371 1.879A2.99 2.99 0 0113 13a2.99 2.99 0 01-.879 2.121z" clip-rule="evenodd"/>
                                </svg>
                                Trending Now
                            </h3>
                            <div class="space-y-4">
                                @php
                                    $trending = \App\Models\Post::where('status', 'published')
                                        ->where('id', '!=', $post->id)
                                        ->orderByDesc('views')
                                        ->take(5)
                                        ->get();
                                @endphp
                                @foreach($trending as $index => $trend)
                                <a href="{{ route('posts.show', $trend) }}" class="flex gap-3 group">
                                    <span class="flex-shrink-0 w-6 h-6 bg-gradient-to-br from-brand-600 to-accent-600 text-white rounded-full flex items-center justify-center text-xs font-bold">
                                        {{ $index + 1 }}
                                    </span>
                                    <div class="flex-1 min-w-0">
                                        <h4 class="text-sm font-medium text-gray-900 dark:text-white line-clamp-2 group-hover:text-brand-600 dark:group-hover:text-brand-400">{{ $trend->title }}</h4>
                                        <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">{{ number_format($trend->views) }} views</p>
                                    </div>
                                </a>
                                @endforeach
                            </div>
                        </div>

                        <!-- Sidebar Ad -->
                        <x-ad-slot position="sidebar_bottom" />
                    </div>
                </aside>
            </div>
        </div>
    </div>

    <!-- Table of Contents Script -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const content = document.getElementById('post-content');
            const tocList = document.getElementById('toc-list');
            
            if (content && tocList) {
                const headings = content.querySelectorAll('h2, h3');
                
                if (headings.length > 0) {
                    headings.forEach((heading, index) => {
                        heading.id = `heading-${index}`;
                        
                        const link = document.createElement('a');
                        link.href = `#heading-${index}`;
                        link.textContent = heading.textContent;
                        link.className = `block py-2 hover:text-brand-600 dark:hover:text-brand-400 transition-colors ${heading.tagName === 'H3' ? 'pl-4 text-xs' : 'font-medium'}`;
                        
                        tocList.appendChild(link);
                    });
                } else {
                    document.getElementById('toc').style.display = 'none';
                }
            }
        });
    </script>
@endsection
