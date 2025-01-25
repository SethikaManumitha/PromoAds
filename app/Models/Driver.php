<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Driver extends Model
{
    //
    protected $fillable = [
        'NIC',
        'name',
        'phone',
        'password',
        'vehicle_type',
        'registration_number',
        'license_number',
    ];
}
