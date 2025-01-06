<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $fillable = ['user_id', 'product_id', 'quantity'];

    public function promotion()
    {
        return $this->belongsTo(Promotion::class, 'product_id');
    }
}
