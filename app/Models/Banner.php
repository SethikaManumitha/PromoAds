<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Banner extends Model
{
    //
    use HasFactory;

    protected $fillable = [
        'image',
        'shop_id',
        'description',
    ];

    public function shop()
    {
        return $this->belongsTo(Business::class, 'shop_id');
    }
}
