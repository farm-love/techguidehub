<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
        xmlns:image="http://www.google.com/schemas/sitemap-image/1.1">
    @foreach($staticPages as $page)
    <url>
        <loc>{{ $page['url'] }}</loc>
        <lastmod>{{ $page['updated_at']->toAtomString() }}</lastmod>
        <changefreq>{{ $page['changefreq'] }}</changefreq>
        <priority>{{ $page['priority'] }}</priority>
    </url>
    @endforeach

    @foreach($posts as $post)
    <url>
        <loc>{{ route('posts.show', $post) }}</loc>
        <lastmod>{{ $post->updated_at->toAtomString() }}</lastmod>
        <changefreq>monthly</changefreq>
        <priority>0.9</priority>
        @if($post->thumbnail)
        <image:image>
            <image:loc>{{ $post->thumbnail }}</image:loc>
            <image:title>{{ $post->title }}</image:title>
        </image:image>
        @endif
    </url>
    @endforeach

    @foreach($categories as $category)
    <url>
        <loc>{{ route('categories.show', $category) }}</loc>
        <lastmod>{{ $category->updated_at->toAtomString() }}</lastmod>
        <changefreq>weekly</changefreq>
        <priority>0.8</priority>
    </url>
    @endforeach

    @foreach($tools as $tool)
    <url>
        <loc>{{ route('tools.show', $tool) }}</loc>
        <lastmod>{{ $tool->updated_at->toAtomString() }}</lastmod>
        <changefreq>monthly</changefreq>
        <priority>0.7</priority>
    </url>
    @endforeach
</urlset>
