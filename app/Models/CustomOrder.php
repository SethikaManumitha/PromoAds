<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomOrder extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'business_id', 'description'];

    /**
     * Relationship: A custom order belongs to a user.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relationship: A custom order belongs to a business.
     */
    public function business()
    {
        return $this->belongsTo(Business::class);
    }
}
