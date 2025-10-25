<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use App\Models\Tool;
use Illuminate\Http\Request;

class SitemapController extends Controller
{
    public function index()
    {
        $posts = Post::where('status', 'published')
            ->orderByDesc('updated_at')
            ->get();
        
        $categories = Category::withCount('posts')
            ->having('posts_count', '>', 0)
            ->orderByDesc('updated_at')
            ->get();
        
        $tools = Tool::orderByDesc('updated_at')->get();
        
        $staticPages = [
            ['url' => route('home'), 'updated_at' => now(), 'priority' => '1.0', 'changefreq' => 'daily'],
            ['url' => route('about'), 'updated_at' => now(), 'priority' => '0.8', 'changefreq' => 'monthly'],
            ['url' => route('contact'), 'updated_at' => now(), 'priority' => '0.7', 'changefreq' => 'monthly'],
            ['url' => route('categories.index'), 'updated_at' => now(), 'priority' => '0.9', 'changefreq' => 'weekly'],
            ['url' => route('tools.index'), 'updated_at' => now(), 'priority' => '0.8', 'changefreq' => 'weekly'],
            ['url' => route('terms'), 'updated_at' => now(), 'priority' => '0.3', 'changefreq' => 'yearly'],
            ['url' => route('privacy'), 'updated_at' => now(), 'priority' => '0.3', 'changefreq' => 'yearly'],
        ];

        return response()
            ->view('sitemap', compact('posts', 'categories', 'tools', 'staticPages'))
            ->header('Content-Type', 'text/xml');
    }

    public function rss()
    {
        $posts = Post::where('status', 'published')
            ->orderByDesc('published_at')
            ->take(20)
            ->get();

        return response()
            ->view('rss', compact('posts'))
            ->header('Content-Type', 'application/xml');
    }
}

