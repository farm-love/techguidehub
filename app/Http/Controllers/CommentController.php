<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(Request $request, Post $post)
    {
        $request->validate([
            'content' => 'required|string|min:3|max:1000',
            'parent_id' => 'nullable|exists:comments,id',
        ]);

        $comment = $post->allComments()->create([
            'user_id' => Auth::id(),
            'parent_id' => $request->parent_id,
            'content' => $request->content,
            'is_approved' => Auth::user()->role === 'admin', // Auto-approve admin comments
        ]);

        if ($comment->is_approved) {
            return back()->with('success', 'Comment posted successfully!');
        }

        return back()->with('success', 'Comment posted successfully and is pending approval!');
    }

    public function destroy(Comment $comment)
    {
        // Only allow users to delete their own comments or admins to delete any
        if (Auth::id() !== $comment->user_id && Auth::user()->role !== 'admin') {
            abort(403, 'Unauthorized action.');
        }

        $comment->delete();

        return back()->with('success', 'Comment deleted successfully!');
    }
}
