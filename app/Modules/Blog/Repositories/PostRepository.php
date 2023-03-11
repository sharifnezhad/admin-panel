<?php

namespace App\Modules\Blog\Repositories;

use App\Modules\Blog\Models\Post;

class PostRepository
{
    const LIMIT = 20;
    const OFFSET = 1;

    /**
     * @param int $offset
     * @param int $limit
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function all(int $offset = self::OFFSET, int $limit = self::LIMIT,)
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
    public function getPost($id)
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

    public function update(Post $post, array $data)
    {
        return Post::query()->find($post->id)->update($data);
    }


}
