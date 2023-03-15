<?php

namespace App\Modules\Blog\Database\Factories;

use App\Modules\Blog\Models\Category;
use App\Modules\Blog\Models\Post;
use App\Modules\Blog\Models\PostCategory;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Modules\Blog\Models\PostCategory>
 */
class CategoryPostFactory extends Factory
{
    protected $model = PostCategory::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'post_id' => Post::factory()->create()->id,
            'category_id' => Category::factory()->create()->id
        ];
    }
}
