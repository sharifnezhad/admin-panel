<?php

namespace App\Modules\Blog\Repositories;

use App\Modules\Blog\Models\Category;
use App\Modules\Blog\Models\PostCategory;
use Illuminate\Database\Eloquent\Model;

class CategoryRepository extends Repository
{
    public function all($dataFilter, $offset = self::OFFSET, $limit = self::LIMIT)
    {
        return Category::query()->with(['postCategories.posts'])
            ->paginate($limit, ['*'], $offset);
    }

    public function create(array $data)
    {
        return Category::create($data);
    }

    public function firstById($id)
    {
        return Category::query()->with('postCategories.posts')->first();
    }

    public function delete($id)
    {
        return Category::query()->whereId($id)->delete();
    }

    public function update(Model $post, array $data)
    {
        return Category::query()->find($post->id)->update($data);
    }
}
