<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostAmount extends Model
{
    use HasFactory;
    protected $guarded =['id'];

    public function post()
    {
        return $this->belongsTo(Post::class);
    }
}
