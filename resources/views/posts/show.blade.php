@extends('layouts.app')

@section('content')
    <div class="post-details-container">
        <h1>{{ $post->title }}</h1>
        <p>{{ $post->body }}</p>
        <p>by {{ $post->user->name }}</p>

        <h2>Comments</h2>
        <ul class="comments-list">
            @foreach($post->comments as $comment)
                <li><b>{{ $comment->author }}</b>: {{ $comment->content }}</li>
            @endforeach
        </ul>

        <form action="{{ route('comments.store') }}" method="POST" class="comment-form">
            @csrf
            <input type="hidden" name="post_id" value="{{ $post->id }}">
            <div>
                <label for="author">Author</label>
                <input type="text" id="author" name="author" required>
            </div>
            <div>
                <label for="content">Comment</label>
                <textarea id="content" name="content" required></textarea>
            </div>
            <button type="submit">Add Comment</button>
        </form>
    </div>
@endsection
