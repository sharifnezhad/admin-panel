<?php

namespace App\Modules\Blog\DataBase\Factories;

use App\Models\User;
use App\Modules\Blog\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 */
class PostFactory extends Factory
{
    protected $model = Post::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'title' => $this->faker->title,
            'description' => $this->faker->text(30),
            'path' => $this->faker->name,
            'user_id' => User::factory()->create()->id,
            'post_type' => 'post',
        ];
    }
}
