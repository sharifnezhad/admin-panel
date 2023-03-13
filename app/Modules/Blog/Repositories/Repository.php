<?php

namespace App\Modules\Blog\Repositories;

use Illuminate\Database\Eloquent\Model;

abstract class Repository
{
    const LIMIT = 20;
    const OFFSET = 1;
    abstract public function all($dataFilter, $offset = self::OFFSET, $limit = self::LIMIT);
    abstract public function create(array $data);
    abstract public function firstById($id);
    abstract public function delete($id);
    abstract public function update(Model $post, array $data);
}
