<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{


    protected $fillable = [
        'fullname',
        'address',
        'city',
        'phone',
        'total',
        'payment_method',
        'driver_id',
        'shop_id'
    ];

    /**
     * Get the driver associated with the order.
     */
    public function driver()
    {
        return $this->belongsTo(Driver::class, 'driver_id', 'NIC');
    }

    public function shop()
    {
        return $this->belongsTo(Business::class, 'shop_id');
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class, 'order_id');
    }
}
