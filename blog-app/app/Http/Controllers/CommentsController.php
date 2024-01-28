<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentsController extends Controller
{
    public function store(Request $request, $postId)
    {
        $validatedData = $request->validate([
            'body' => 'required|string|max:255',
        ]);

        $comment = new Comment([
            'on_post' => $postId,
            'from_user' => Auth::id(),
            'body' => $validatedData['body'],
            'at_time' => now(),
        ]);

        $comment->save();

        return redirect()->route('blog-posts.index')->with('success', 'Post created successfully!');
    }
}
