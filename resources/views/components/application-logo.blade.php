@php
    $light = asset('storage/images/logo-light.jpg');
    $dark = asset('storage/images/logo-dark.jpg');
    // alt fallback and capture class/width/height passed from caller
    $alt = $attributes->get('alt', config('app.name', 'App Logo'));
    $imgAttrs = $attributes->except(['alt']);
    // Ensure there's always a sensible default size when none provided
    if (! $imgAttrs->has('class') && ! $imgAttrs->has('width') && ! $imgAttrs->has('height')) {
        $imgAttrs = $imgAttrs->merge(['class' => 'w-10 h-10']);
    }
@endphp

<picture>
    <source srcset="{{ $dark }}" media="(prefers-color-scheme: dark)">
    <img src="{{ $light }}" alt="{{ $alt }}" {{ $imgAttrs }} />
</picture>
