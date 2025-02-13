<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Post;

class BlogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Post::factory()->count(500)->create();
    }
}
