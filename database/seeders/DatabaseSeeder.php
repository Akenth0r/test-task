<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::factory(50)->create()->each(function($user){
           $posts = Post::factory(rand(2,10))->make();
           $user->posts()->saveMany($posts);
        });
        // \App\Models\User::factory(10)->create();
    }
}
