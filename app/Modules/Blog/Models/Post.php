<?php

namespace App\Modules\Blog\Models;

use App\Models\User;
use App\Modules\Blog\DataBase\Factories\PostFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $table = 'posts';
    protected $keyType = 'string';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id',
        'title',
        'description',
        'user_id',
        'path',
        'post_type'
    ];

    /**
     * get user
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    protected static function newFactory()
    {
        return PostFactory::new();
    }

    public function postCategory()
    {
        return $this->hasMany(PostCategory::class);
    }
}
