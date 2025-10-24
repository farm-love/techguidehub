<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class PostApiController extends Controller
{
    public function index(Request $request)
    {
        $posts = Post::query()
            ->where('status', 'published')
            ->orderByDesc('published_at')
            ->paginate(10);

        return response()->json($posts);
    }

    public function show(Post $post)
    {
        abort_unless($post->status === 'published', 404);
        return response()->json($post->load('tags', 'category'));
    }
}


