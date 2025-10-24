<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Category;
use App\Models\Tag;
use App\Models\User;
use App\Models\Ad;
use App\Models\Setting;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'posts' => Post::count(),
            'published_posts' => Post::where('status', 'published')->count(),
            'draft_posts' => Post::where('status', 'draft')->count(),
            'scheduled_posts' => Post::where('status', 'scheduled')->count(),
            'categories' => Category::count(),
            'tags' => Tag::count(),
            'users' => User::count(),
            'ads' => Ad::count(),
        ];

        $recentPosts = Post::with(['category', 'user'])
            ->orderByDesc('created_at')
            ->limit(5)
            ->get();

        $topCategories = Category::withCount('posts')
            ->orderByDesc('posts_count')
            ->limit(5)
            ->get();

        return view('admin.dashboard', compact('stats', 'recentPosts', 'topCategories'));
    }
}
