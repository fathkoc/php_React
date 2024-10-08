<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table = 'users';
    protected $fillable = ['name', 'username', 'email'];
    public $timestamps = true;

    public function posts()
    {
        return $this->hasMany(Post::class, 'userId');
    }
}
