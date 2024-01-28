<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class BlogPostController extends Controller
{
    public function index()
    {
        $allPosts = Post::with('writer:id,name,role', 'comments')->get();

        return view('blog-posts.index', compact('allPosts'));
    }

    public function myPosts()
    {
        $user = Auth::user();
        $posts = Post::with('writer:id,name,role', 'comments')->where('author', $user->id)->get();

        return view('my-posts.my-posts', compact('posts'));
    }

    public function create()
    {
        return view('my-posts.add-post');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required|string',
        ]);

        $user = Auth::user();

        $post = new Post([
            'author' => $user->id,
            'title' => $request->input('title'),
            'body' => $request->input('body'),
            'slug' => Str::slug($request->input('title')),
            'published_on' => now(),
            'last_modified' => now(),
            'active' => true,
        ]);

        $post->save();

        return redirect()->route('blog-posts.index')->with('success', 'Post created successfully!');
    }

    public function edit($id)
    {
        $post = Post::find($id);

        if (!$post) {
            return redirect()->back()->with('error', 'Post not found');
        }

        return view('my-posts.edit-post', ['post' => $post]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|max:255',
            'body' => 'required',
        ]);

        $post = Post::find($id);

        if (!$post) {
            return redirect()->back()->with('error', 'Post not found');
        }

        $post->title = $request->input('title');
        $post->body = $request->input('body');
        $post->save();

        return redirect()->route('my-posts.myPosts');
    }

    public function delete($id)
    {
        try {
            $post = Post::findOrFail($id);
            $post->delete();
            return redirect()->route('my-posts.myPosts');
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'Post not found'], 404);
        }
    }

}
