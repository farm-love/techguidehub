<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\View;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $query = Post::query()->where('status', 'published');

        // basic search support: q -> title, excerpt, content
        if ($q = request('q')) {
            $query->where(function ($qbuilder) use ($q) {
                $qbuilder->where('title', 'like', "%{$q}%")
                    ->orWhere('excerpt', 'like', "%{$q}%")
                    ->orWhere('content', 'like', "%{$q}%");
            });
        }

        $posts = $query->orderByDesc('published_at')->paginate(12)->withQueryString();

        return view('posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        abort_unless($post->status === 'published', 404);
        $post->increment('views');

        $related = Post::where('status', 'published')
            ->where('category_id', $post->category_id)
            ->where('id', '!=', $post->id)
            ->orderByDesc('published_at')
            ->limit(6)
            ->get();

        return view('posts.show', compact('post', 'related'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        //
    }
}
