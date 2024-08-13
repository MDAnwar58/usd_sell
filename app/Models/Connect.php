<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Connect extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    protected $fillable = [
        'to_id',
        'from_id',
        'status',
    ];

    public function toUser()
    {
        return $this->belongsTo(User::class, 'to_id');
    }
    public function fromUser()
    {
        return $this->belongsTo(User::class, 'from_id');
    }
}
