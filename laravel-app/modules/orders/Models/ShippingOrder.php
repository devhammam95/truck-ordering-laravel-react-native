<?php

namespace Orders\Models;

use Illuminate\Database\Eloquent\Model;

class ShippingOrder extends Model
{
    public $fillable = [
        'user_id',
        'location',
        'size',
        'weight',
        'status',
        // 'delivery_date',
        // 'delivery_time',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
