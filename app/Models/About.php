<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class About extends Model
{
    use HasFactory;

    // Specify the table name
    protected $table = 'about';

    protected $fillable = [
        'image',
        'shop_id',
    ];

    public function shop()
    {
        return $this->belongsTo(Business::class, 'shop_id');
    }
}
