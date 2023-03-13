<?php

namespace App\Modules\Blog\Repositories;

use App\Modules\Blog\Models\Post;
use Illuminate\Database\Eloquent\Model;

class PostRepository extends Repository
{
    /**
     * @param int $offset
     * @param int $limit
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function all($dataFilter, $offset = self::OFFSET, $limit = self::LIMIT)
    {
        return Post::query()->with(['user'])
            ->paginate($limit, ['*'], $offset);
    }

    /**
     * @param array $data
     * @return mixed
     */
    public function create(array $data)
    {
        return Post::create($data);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function firstById($id)
    {
        return Post::find($id);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function delete($id)
    {
        return Post::query()->whereId($id)->delete();
    }

    public function update(Model $post, array $data)
    {
        return Post::query()->find($post->id)->update($data);
    }


}
