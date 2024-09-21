@extends('layouts.app')

@section('content')
    <div class="user-details-container">
        <h1>{{ $user->name }}</h1>
        <p>{{ $user->email }}</p>

        <h2>Posts</h2>
        <table class="posts-table">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Total Comments</th>
                </tr>
            </thead>
            <tbody>
                @foreach($user->posts as $post)
                    <tr>
                        <td><a href="{{ route('posts.show', $post->id) }}">{{ $post->title }}</a></td>
                        <td>{{ $post->comments()->count() }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
