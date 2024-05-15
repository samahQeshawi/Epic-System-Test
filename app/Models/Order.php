<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'invitation_id',
        'package_id',
        'payment_method_id',
        'coupon_id',
        'discount',
        'total',
        'phone',
        'status',
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }
}
