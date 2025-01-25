<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Serivce extends Model
{
    //
    protected $table = 'service';

    protected $fillable = [
        'name',
        'category',
        'description',
        'price',
        'dis_price',
        'NIC',
        'image'
    ];
}
