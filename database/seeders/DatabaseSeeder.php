<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Post;
use App\Models\Comment;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        User::factory(10)->create()->each(function ($user) {
            Post::factory(5)->create(['user_id' => $user->id])->each(function ($post) {
                Comment::factory(10)->create(['post_id' => $post->id]);
            });
        });
    }
}