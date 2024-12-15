<?php

namespace Orders\Models;

use Illuminate\Database\Eloquent\Model;
use Users\Models\User;

class ShippingOrder extends Model
{
    public $fillable = [
        'user_id',
        'location',
        'size',
        'weight',
        'status',
        'delivery_pickup_type',
        'delivery_pickup_date_time'
    ];

   
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
