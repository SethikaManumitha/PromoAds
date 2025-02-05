<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Business;
use App\Models\Driver;
use App\Models\User;
use App\Models\Cart;

use Illuminate\Support\Facades\DB;


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

            if ($status != "0") {
                switch ($role) {
                    case "business":
                        $business = Business::where('business_name', $name)->first();

                        if (!$business) {
                            return back()->withErrors([
                                'message' => 'No business account found for this user.',
                            ])->withInput();
                        }

                        session(['business_id' => $business->id]);

                        $totalViews = DB::table('promo_views')
                            ->where('business_id', $business->id)
                            ->sum('views');

                        $uniqueVisitorsCount = DB::table('promo_views')
                            ->where('business_id', $business->id)
                            ->distinct('visitor_id')
                            ->count('visitor_id');

                        // Existing cart logic
                        $carts = Cart::with(['promotion.business', 'user'])
                            ->whereHas('promotion', function ($query) use ($business) {
                                $query->where('business_id', $business->id);
                            })
                            ->get();

                        $groupedCarts = $carts->groupBy('user_id')->map(function ($group) {
                            return $group->groupBy('promotion_id')->map(function ($promotionGroup) {
                                return [
                                    'promotion' => $promotionGroup->first()->promotion,
                                    'total_quantity' => $promotionGroup->sum('quantity'),
                                    'user' => $promotionGroup->first()->user,
                                ];
                            });
                        });

                        return view('admin.businessDashboard', [
                            'uniqueVisitorsCount' => $uniqueVisitorsCount,
                            'totalViews' => $totalViews,
                            'groupedCarts' => $groupedCarts,
                        ]);

                    case "customer":
                        return redirect()->route('index');

                    case "driver":
                        $driver = Driver::where('name', $name)->first();
                        session(['nic' => $driver->NIC]);
                        return view('admin.driverDashboard');

                    case "admin":
                        $users = User::all();
                        return view('admin.adminDashboard', compact('users'));

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
