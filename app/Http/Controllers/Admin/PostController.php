<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::with(['category', 'user', 'tags'])
            ->orderByDesc('created_at')
            ->paginate(20);
        
        return view('admin.posts.index', compact('posts'));
    }

    public function create()
    {
        $categories = Category::orderBy('name')->get();
        $tags = Tag::orderBy('name')->get();
        return view('admin.posts.create', compact('categories', 'tags'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|unique:posts,slug',
            'excerpt' => 'nullable|string|max:500',
            'content' => 'required|string',
            'category_id' => 'nullable|exists:categories,id',
            'tags' => 'nullable|array',
            'tags.*' => 'exists:tags,id',
            'status' => 'required|in:draft,scheduled,published',
            'published_at' => 'nullable|date',
            'is_featured' => 'nullable|boolean',
            'thumbnail' => 'nullable|string',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:500',
            'canonical_url' => 'nullable|url',
        ]);

        if (empty($data['slug'])) {
            $data['slug'] = Str::slug($data['title']);
        }

        if ($data['status'] === 'published' && empty($data['published_at'])) {
            $data['published_at'] = now();
        }

        $data['user_id'] = auth()->id();
        $data['is_featured'] = $request->has('is_featured');

        $post = Post::create($data);
        
        if (!empty($data['tags'])) {
            $post->tags()->sync($data['tags']);
        }

        return redirect()->route('admin.posts.index')->with('success', 'Post created successfully!');
    }

    public function edit(Post $post)
    {
        $categories = Category::orderBy('name')->get();
        $tags = Tag::orderBy('name')->get();
        $postTags = $post->tags->pluck('id')->toArray();
        
        return view('admin.posts.edit', compact('post', 'categories', 'tags', 'postTags'));
    }

    public function update(Request $request, Post $post)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|unique:posts,slug,' . $post->id,
            'excerpt' => 'nullable|string|max:500',
            'content' => 'required|string',
            'category_id' => 'nullable|exists:categories,id',
            'tags' => 'nullable|array',
            'tags.*' => 'exists:tags,id',
            'status' => 'required|in:draft,scheduled,published',
            'published_at' => 'nullable|date',
            'is_featured' => 'nullable|boolean',
            'thumbnail' => 'nullable|string',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:500',
            'canonical_url' => 'nullable|url',
        ]);

        if (empty($data['slug'])) {
            $data['slug'] = Str::slug($data['title']);
        }

        if ($data['status'] === 'published' && empty($data['published_at'])) {
            $data['published_at'] = now();
        }

        $data['is_featured'] = $request->has('is_featured');

        $post->update($data);
        
        if (isset($data['tags'])) {
            $post->tags()->sync($data['tags'] ?? []);
        }

        return redirect()->route('admin.posts.index')->with('success', 'Post updated successfully!');
    }

    public function destroy(Post $post)
    {
        $post->delete();
        return back()->with('success', 'Post deleted successfully!');
    }
}
