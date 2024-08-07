<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PostController extends Controller
{

    public function index()
    {
        return Inertia::render('Posts/Index', [
            'posts' => Post::with('user:id,name')->latest()->get()
        ]);
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:100|min:1',
            'body' => 'required|string|max:255|min:1'
        ]);

        $request->user()->posts()->create($validated);

        return redirect(route('posts.index'));
    }


    public function show(Post $post)
    {
        //
    }


    public function edit(Post $post)
    {
        //
    }


    public function update(Request $request, Post $post)
    {
        $this->authorize('update', $post);

        $validated = $request->validate([
            'title' => 'required|string|max:100|min:1',
            'body' => 'required|string|max:255|min:1'
        ]);

        $post->update($validated);

        return redirect(route('posts.index'));
    }


    public function destroy(Post $post)
    {
        $this->authorize('delete', $post);

        $post->delete();

        return redirect(route('posts.index'));
    }
}
