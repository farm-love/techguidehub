<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;

class CategoryApiController extends Controller
{
    public function index()
    {
        $categories = Category::withCount('posts')->orderBy('order')->get();
        return response()->json($categories);
    }

    public function show(Category $category)
    {
        $category->load(['children', 'posts' => function ($q) {
            $q->where('status', 'published')->orderByDesc('published_at');
        }]);
        return response()->json($category);
    }
}


