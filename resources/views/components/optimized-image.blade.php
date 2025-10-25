@props(['src', 'alt' => '', 'width' => null, 'height' => null, 'class' => ''])

@php
    // Generate responsive srcset and sizes
    $sizes = [320, 640, 768, 1024, 1280, 1536];
    $srcset = [];
    
    // For now, we'll just use the original image
    // In production, you would generate different sizes using an image service
    foreach ($sizes as $size) {
        $srcset[] = $src . " {$size}w";
    }
    
    $srcsetAttr = implode(', ', $srcset);
    $sizesAttr = '(max-width: 640px) 100vw, (max-width: 1024px) 50vw, 33vw';
@endphp

<img 
    src="{{ $src }}" 
    alt="{{ $alt }}"
    @if($width) width="{{ $width }}" @endif
    @if($height) height="{{ $height }}" @endif
    loading="lazy"
    decoding="async"
    class="{{ $class }} lazy-loading"
    {{ $attributes }}
>

