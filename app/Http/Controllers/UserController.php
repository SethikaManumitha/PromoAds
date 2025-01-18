<?php

namespace App\Http\Controllers;

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Business;

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
            $status = $user->status;

            session(['user_id' => $id]);
            session(['user_name' => $name]);

            if ($status == "1") {
                switch ($role) {
                    case "business":
                        $business = Business::where('business_name', $name)->first();
                        session(['business_id' => $business->id]);
                        return view('admin.businessDashboard');

                    case "customer":
                        return redirect()->route('index');

                    case "driver":
                        return view('driverDashboard');

                    default:
                        abort(403, "Unauthorized action.");
                }
            }
        }

        return back()->withErrors([
            'message' => 'Invalid credentials, please try again.',
        ])->withInput();
    }
}
