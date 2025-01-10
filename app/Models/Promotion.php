<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Promotion extends Model
{
    use HasFactory;


    protected $table = 'promotion';

    protected $fillable = [
        'name',
        'category',
        'description',
        'price',
        'dis_price',
        'loy_price',
        'end_date',
        'business',
        'image'
    ];
}
