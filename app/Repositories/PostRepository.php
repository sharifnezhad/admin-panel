<?php

namespace App\Repositories;

use App\Models\Post;

class PostRepository
{
    private static Post $postModel;
    const LIMIT = 10;

    public function __construct(Post $post)
    {
        self::$postModel = $post;
    }

    public static function get($filter, $limit = self::LIMIT, $offset = 0)
    {
        return self::$postModel->with(['user'])
            ->where('post_type', $filter['name'])
            ->paginate(self::LIMIT, $offset);
    }
}
