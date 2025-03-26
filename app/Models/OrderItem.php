<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    // The table associated with the model
    protected $table = 'order_items';

    // Fillable properties for mass assignment
    protected $fillable = [
        'order_id',
        'product_id',
    ];


    public function order()
    {
        return $this->belongsTo(Order::class);
    }


    public function product()
    {
        return $this->belongsTo(Promotion::class);
    }
}
