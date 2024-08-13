<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PaymentMethod extends Model
{
    use HasFactory, SoftDeletes;
    protected $guarded = ['id'];

    protected $fillable = [
        'payment_method_type_id',
        'name',
        'min_amount',
        'max_amount',
        'commission',
        'account_no',
        'image',
        'status',
    ];

    public function payment_method_type()
    {
        return $this->belongsTo(PaymentMethodType::class, 'payment_method_type_id');
    }
}
