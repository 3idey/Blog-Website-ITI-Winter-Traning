<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(10)->create();

        Post::factory(50)->create()->each(function ($post) {
            $post->image = 'images/' . fake()->image('public/storage/images', 640, 480, null, false);
            $post->save();
        });

        $this->call(BlogSeeder::class);
    }
}
