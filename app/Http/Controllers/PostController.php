<?php
namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Support\Facades\Cache;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $posts = Cache::remember('posts', 60, function () {
            return Post::with('user')->get();
        });

        return view('posts.index', compact('posts'));
    }

    public function show($id)
    {
        $post = Cache::remember("post_{$id}", 60, function () use ($id) {
            return Post::with('user', 'comments')->findOrFail($id);
        });

        return view('posts.show', compact('post'));
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store(Request $request)
    {
        $post = Post::create($request->all());
        Cache::forget('posts');
        return redirect()->route('posts.index');
    }

    public function edit($id)
    {
        $post = Post::findOrFail($id);
        return view('posts.edit', compact('post'));
    }

    public function update(Request $request, $id)
    {
        $post = Post::findOrFail($id);
        $post->update($request->all());
        Cache::forget("post_{$id}");
        Cache::forget('posts');
        return redirect()->route('posts.index');
    }

    public function destroy($id)
    {
        Post::destroy($id);
        Cache::forget("post_{$id}");
        Cache::forget('posts');
        return redirect()->route('posts.index');
    }
}
