<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WalletHistory extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $fillable = [
        'user_id',
        'wallet_id',
        'for',
        'gateway',
        'subject',
        'desc',
        'tranjection',
        'to_number',
        'from_number',
        'change_amount',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
