<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Post;
use App\Models\User;

class PostFactory extends Factory
{
    protected $model = Post::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence,
            'description' => $this->faker->paragraph,
            'posted_by' => $this->faker->name,
            'created_at' => $this->faker->dateTimeThisYear,
            'user_id' => User::factory(),
            'image' => 'images/' . $this->faker->image('public/storage/images', 640, 480, null, false)
        ];
    }
}
