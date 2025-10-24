<?xml version="1.0" encoding="UTF-8"?>
<rss version="2.0">
  <channel>
    <title>{{ config('app.name') }}</title>
    <link>{{ url('/') }}</link>
    <description>Latest posts from {{ config('app.name') }}</description>
    @foreach($posts as $post)
      <item>
        <title>{{ $post->title }}</title>
        <link>{{ route('posts.show', $post) }}</link>
        <guid>{{ route('posts.show', $post) }}</guid>
        <pubDate>{{ optional($post->published_at)->toRfc2822String() }}</pubDate>
        <description><![CDATA[{!! $post->excerpt ?: \Illuminate\Support\Str::limit(strip_tags($post->content), 160) !!}]]></description>
      </item>
    @endforeach
  </channel>
</rss>


