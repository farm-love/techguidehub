@props([
    'title' => null,
    'description' => null,
    'url' => null,
    'image' => null,
    'type' => 'website',
    'schema' => null,
    'canonical' => null,
    'noindex' => false,
])
@if($title)
    <title>{{ $title }}</title>
@endif
@if($description)
    <meta name="description" content="{{ $description }}" />
@endif
@if($canonical)
    <link rel="canonical" href="{{ $canonical }}" />
@endif
@unless($canonical)
    {{-- fallback to current url if canonical not provided --}}
    <link rel="canonical" href="{{ $url ?? url()->current() }}" />
@endunless
@if($noindex)
    <meta name="robots" content="noindex,follow" />
@endif
<meta property="og:type" content="{{ $type }}" />
@if($title)
    <meta property="og:title" content="{{ $title }}" />
@endif
@if($description)
    <meta property="og:description" content="{{ $description }}" />
@endif
@if($url)
    <meta property="og:url" content="{{ $url }}" />
@endif
@if($image)
    <meta property="og:image" content="{{ $image }}" />
@endif
<meta property="og:site_name" content="{{ config('app.name') }}" />
<meta property="og:locale" content="{{ str_replace('_','-',app()->getLocale()) }}" />

{{-- Twitter card --}}
<meta name="twitter:card" content="summary_large_image" />
@if(config('services.twitter.username'))
    <meta name="twitter:site" content="@{{ config('services.twitter.username') }}" />
@endif
@if($title)
    <meta name="twitter:title" content="{{ $title }}" />
@endif
@if($description)
    <meta name="twitter:description" content="{{ $description }}" />
@endif
@if($image)
    <meta name="twitter:image" content="{{ $image }}" />
@endif
@if($schema)
    <script type="application/ld+json">{!! json_encode($schema) !!}</script>
@endif


