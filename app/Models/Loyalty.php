<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Loyalty extends Model
{
    use HasFactory;

    protected $table = 'loyalty';

    protected $fillable = ['user_id', 'business_id'];

    /**
     * Get the user associated with the loyalty entry.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }


    public function business()
    {
        return $this->belongsTo(User::class, 'business_id');
    }
}
