<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Cache;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = Cache::remember('users', 60, function () {
            return User::with('posts')->get();
        });

        return view('users.index', compact('users'));
    }

    public function show($id)
    {
        $user = Cache::remember("user_{$id}", 60, function () use ($id) {
            return User::with('posts')->findOrFail($id);
        });

        return view('users.show', compact('user'));
    }

    public function create()
    {
        return view('users.create');
    }

    public function store(Request $request)
    {
        $user = User::create($request->all());
        Cache::forget('users');
        return redirect()->route('users.index');
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('users.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->update($request->all());
        Cache::forget("user_{$id}");
        Cache::forget('users');
        return redirect()->route('users.index');
    }

    public function destroy($id)
    {
        User::destroy($id);
        Cache::forget("user_{$id}");
        Cache::forget('users');
        return redirect()->route('users.index');
    }
}


