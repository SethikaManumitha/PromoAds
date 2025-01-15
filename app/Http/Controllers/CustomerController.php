<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\User;

class CustomerController extends Controller
{
    public function showSignUpForm()
    {
        return view('signup.customerSignUp');
    }

    public function insertCustomer(Request $request)
    {
        // Validate the incoming request
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:customers,email',
            'phone_number' => 'required|numeric',
            'address' => 'required|string',
            'city' => 'required|string',
            'password' => 'required|string|min:8',
        ]);

        // Save the data in the database
        Customer::create([
            'name' => $validated['name'],
            'address' => $validated['address'],
            'city' => $validated['city'],
            'phone_number' => $validated['phone_number'],
            'email' => $validated['email']
        ]);

        User::create([
            'name' => $validated['name'],
            'email' => $validated['phone_number'],
            'phone' => $validated['phone_number'],
            'password' => bcrypt($validated['password']),
            'role' => 'customer',
        ]);

        // Return a response or redirect as necessary
        return redirect()->route('login')->with('success', 'Customer created successfully! Please log in.');
    }
}
