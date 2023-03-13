<?php

namespace App\Modules\Blog\Models;

use App\Modules\Blog\DataBase\Factories\CategoryFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'path',
        'description',
        'post_ids'
    ];
    protected $casts = [
        'post_ids' => 'array'
    ];

    protected static function newFactory()
    {
        return CategoryFactory::new();
    }

    public function postCategories()
    {
        return $this->hasOne(PostCategory::class);
    }
}
