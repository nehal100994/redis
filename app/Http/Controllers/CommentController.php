<?php
namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Support\Facades\Cache;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request)
    {
        $comment = Comment::create($request->all());
        Cache::forget("post_{$comment->post_id}");
        return redirect()->route('posts.show', $comment->post_id);
    }

    public function destroy($id)
    {
        $comment = Comment::findOrFail($id);
        $postId = $comment->post_id;
        $comment->delete();
        Cache::forget("post_{$postId}");
        return redirect()->route('posts.show', $postId);
    }
}

