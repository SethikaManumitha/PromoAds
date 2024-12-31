<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Business;
use App\Models\User;    

class BusinessController extends Controller
{
    public function store(Request $request)
    {
        // Validate the incoming data
        $validated = $request->validate([
            'business_name' => 'required|string|max:255',
            'business_type' => 'required|string|max:255',
            'descript' => 'nullable|string',
            'email' => 'required|email|max:255',
            'phone_number' => 'required|string|max:10',
            'password' => 'required|string|min:6',
        ]);

        // Save the data in the database
        Business::create([
            'business_name' => $validated['business_name'],
            'business_type' => $validated['business_type'],
            'description' => $validated['descript'],
            'email' => $validated['email'],
            'phone_number' => $validated['phone_number'],
            'password' => bcrypt($validated['password']), 
        ]);

        $user = User::create([
            'name' => $validated['business_name'],  
            'email' => $validated['email'],
            'phone' => $validated['phone_number'],
            'password' => bcrypt($validated['password']),
            'role' => 'business', 
        ]);

        echo "Test";
        return redirect()->route('genQR')->with('success', 'Business registered successfully!');
    }
}

