<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Driver;
use App\Models\Business;
use App\Models\User;

class DriverController extends Controller
{
    //
    public function store(Request $request)
    {
        // Validate the incoming data
        $validated = $request->validate([
            'nic' => 'required|string|max:20',
            'name' => 'required|string|max:255',
            'phone_number' => 'required|string|max:15',
            'password' => 'required|string|min:8',
            'vehicle_type' => 'required|string|max:255',
            'registration_number' => 'required|string|max:50',
            'license_number' => 'required|string|max:50',
        ]);

        $driver = Driver::create([
            'NIC' => $validated['nic'],
            'name' => $validated['name'],
            'phone' => $validated['phone_number'],
            'password' => bcrypt($validated['password']),
            'vehicle_type' => $validated['vehicle_type'],
            'registration_number' => $validated['registration_number'],
            'license_number' => $validated['license_number'],
        ]);


        User::create([
            'name' => $validated['name'],
            'email' => $validated['phone_number'],
            'phone' => $validated['phone_number'],
            'password' => bcrypt($validated['password']),
            'role' => 'driver',
            'status' => '0'
        ]);

        return redirect()->route('genQR')->with('success', 'Driver registered successfully!');
    }
}
