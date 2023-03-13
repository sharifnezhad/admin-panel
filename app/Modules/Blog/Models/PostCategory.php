<?php

namespace App\Modules\Blog\Models;

use App\Modules\Blog\DataBase\Factories\CategoryPostFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostCategory extends Model
{
    use HasFactory;
    protected $table = 'category_posts';
    protected $fillable = [
        'post_id',
        'category_id'
    ];
    public $timestamps = false;
    protected static function newFactory()
    {
        return CategoryPostFactory::new();
    }

    public function posts()
    {
        return $this->belongsToMany(Post::class, 'category_posts', 'category_id');
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'category_posts', 'post_id');
    }
}
