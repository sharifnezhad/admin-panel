<?php

namespace App\Modules\Blog\Database\Factories;

use App\Modules\Blog\Models\Post;
use App\Modules\Blog\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Modules\Blog\Models\Category>
 */
class CategoryFactory extends Factory
{
    protected $model = Category::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'title' => $this->faker->name,
            'description' => $this->faker->text(30),
            'path' => $this->faker->name,
        ];
    }
}
