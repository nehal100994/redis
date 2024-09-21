@extends('layouts.app')

@section('content')
<div class="form-container">
    <h1>Edit User</h1>
    <form action="{{ route('users.update', $user->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div>
            <label for="name">Name</label>
            <input type="text" id="name" name="name" value="{{ $user->name }}">
        </div>
        <div>
            <label for="email">Email</label>
            <input type="email" id="email" name="email" value="{{ $user->email }}">
        </div>
        <button type="submit">Update User</button>
    </form>
</div>
@endsection

