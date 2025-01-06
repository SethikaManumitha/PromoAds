<?php

namespace App\Http\Controllers;

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class UserController extends Controller
{
    public function authenticate(Request $request)
    {
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $id = $user->id;
            $name = $user->name;
            $role = $user->role;

            session(['user_id' => $id]);
            session(['user_name' => $name]);
            if ($role == "business") {
                return view('admin.businessDashboard');
            } elseif ($role == "customer") {
                return view('customerDashboard');
            } else {
                return view('driverDashboard');
            }
        }

        return back()->withErrors([
            'message' => 'Invalid credentials, please try again.',
        ])->withInput();
    }
}
