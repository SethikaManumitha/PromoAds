<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'shop_id',
        'name',
        'description',
        'price',
        'special_price',
        'image',
    ];

    public function shop()
    {
        return $this->belongsTo(Business::class, 'shop_id');
    }
}
