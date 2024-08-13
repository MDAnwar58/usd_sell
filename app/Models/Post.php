<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use HasFactory, SoftDeletes;
    protected $guarded = ['id'];
    protected $fillable = [
        'category_id',
        'for',
        'for',
        'user_id',
        'quality',
        'rate',
        'limit',
        'exchange_amount',
        'like',
        'trade',
        'completion',
        'contact_number',
        'gateway',
        'relise_user',
        'status',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function amount()
    {
        return $this->belongsTo(PostAmount::class);
    }
}
