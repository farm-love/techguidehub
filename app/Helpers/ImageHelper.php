<?php

namespace App\Helpers;

class ImageHelper
{
    /**
     * Generate optimized image tag with responsive sizes
     */
    public static function optimized(string $src, array $options = []): string
    {
        $alt = $options['alt'] ?? '';
        $class = $options['class'] ?? '';
        $width = $options['width'] ?? null;
        $height = $options['height'] ?? null;
        
        $sizes = [320, 640, 768, 1024, 1280, 1536];
        $srcset = [];
        
        // In a real implementation, you would generate different sizes
        // using an image optimization service like Cloudinary, ImageKit, or Laravel's image manipulation
        foreach ($sizes as $size) {
            $srcset[] = "{$src} {$size}w";
        }
        
        $srcsetAttr = implode(', ', $srcset);
        $sizesAttr = '(max-width: 640px) 100vw, (max-width: 1024px) 50vw, 33vw';
        
        $widthAttr = $width ? "width=\"{$width}\"" : '';
        $heightAttr = $height ? "height=\"{$height}\"" : '';
        
        return "<img src=\"{$src}\" alt=\"{$alt}\" {$widthAttr} {$heightAttr} loading=\"lazy\" decoding=\"async\" class=\"{$class} lazy-loading\">";
    }
    
    /**
     * Get WebP version of image if exists
     */
    public static function getWebP(string $path): string
    {
        $webpPath = preg_replace('/\.(jpg|jpeg|png)$/i', '.webp', $path);
        
        if (file_exists(public_path($webpPath))) {
            return $webpPath;
        }
        
        return $path;
    }
    
    /**
     * Get responsive srcset for an image
     */
    public static function getSrcset(string $src, array $sizes = [320, 640, 768, 1024, 1280, 1536]): string
    {
        $srcset = [];
        
        foreach ($sizes as $size) {
            // In production, this would generate actual resized images
            $srcset[] = "{$src} {$size}w";
        }
        
        return implode(', ', $srcset);
    }
}

