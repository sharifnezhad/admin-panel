<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;
    protected $table = 'roles';
    protected $fillable = [
        'name',
        'path',
        'policies'
    ];
    protected $casts = [
        'policies' => 'array'
    ];

    public function user()
    {
        $this->belongsToMany(User::class, 'users', 'role_id', 'id');
    }
}
