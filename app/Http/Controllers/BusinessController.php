<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Business;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class BusinessController extends Controller
{

    public function showDashboard()
    {
        return view('admin.businessDashboard');
    }


    public function showProfile()
    {
        $user = Auth::user();
        return view('admin.profile', compact('user'));
    }

    public function getBusiness()
    {
        $business = Business::all();

        foreach ($business as $biz) {
            $biz->user = User::where('email', $biz->email)->first();
        }
        return view('index', compact('business'));
    }

    public function updateProfile(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'profile_picture' => 'nullable|mimes:png,jpg,jpeg,webp',
        ]);

        $user = Auth::user();

        // Ensure the user is an instance of the User model
        if (!$user instanceof User) {
            return redirect()->route('login')->with('error', 'User is not valid.');
        }

        if (!$user) {
            return redirect()->route('login')->with('error', 'You must be logged in to update your profile.');
        }

        if ($request->has('profile_photo')) {
            $file = $request->file('profile_photo');
            $extension = $file->getClientOriginalExtension();
            $path = 'uploads/profile/';
            $filename = time() . "." . $extension;
            $file->move(public_path($path), $filename);

            if ($user->image && file_exists(public_path($user->image))) {
                unlink(public_path($user->image));
            }

            $user->profile = $path . $filename;
        }

        // Update other user information
        $user->name = $validated['name'];
        $user->email = $validated['email'];

        // Save user data in the database
        $user->save();

        return redirect()->route('admin.profile')->with('success', 'Profile updated successfully!');
    }



    public function store(Request $request)
    {
        // Validate the incoming data
        $validated = $request->validate([
            'business_name' => 'required|string|max:255',
            'business_type' => 'required|string|max:255',
            'descript' => 'nullable|string',
            'email' => 'required|email|max:255',
            'phone_number' => 'required|string|max:10',
            'password' => 'required|string|min:8',
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

        return redirect()->route('genQR')->with('success', 'Business registered successfully!');
    }
}
