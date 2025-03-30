<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Business;
use App\Models\Driver;
use App\Models\User;
use App\Models\Cart;
use App\Models\Customer;
use App\Models\Promotion;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

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

                        $response = Http::get("https://model-production-5ace.up.railway.app/recommend/" . urlencode($business->id));

                        if ($response->successful()) {
                            $data = $response->json();
                            $recommendedShops = $data['recommendations'] ?? [];

                            $recommendedShops = collect($recommendedShops)->map(function ($shop) {
                                $business = Business::where('id', $shop['id'])->first();
                                $user = $business ? User::where('name', $business->business_name)->first() : null;
                                return [
                                    'id' => $shop['id'],
                                    'business_name' => $business->business_name ?? 'Unknown',
                                    'business_type' =>  $business->business_type ?? 'Unknown',
                                    'description' => $business->description ?? '',
                                    'image_url' => $user->profile,
                                ];
                            })->toArray();
                        } else {
                            $recommendedShops = [];
                        }

                        $Id = $business->id;
                        $topProducts = Cart::select('product_id', DB::raw('SUM(quantity) as total_quantity'))
                            ->whereHas('promotion', function ($query) use ($Id) {
                                $query->where('business_id', $Id);
                            })
                            ->groupBy('product_id')
                            ->orderByDesc('total_quantity')
                            ->take(3)
                            ->with('promotion')
                            ->get();

                        $promotionsNew = Promotion::where('business_id', session('business_id'))->take(6)->get();

                        // Fetch the orders count grouped by month
                        $ordersCount = DB::table('orders')
                            ->select(DB::raw('MONTH(created_at) as month'), DB::raw('YEAR(created_at) as year'), DB::raw('COUNT(*) as order_count'))
                            ->where('shop_id', $business->id)
                            ->groupBy(DB::raw('YEAR(created_at)'), DB::raw('MONTH(created_at)'))
                            ->orderBy(DB::raw('YEAR(created_at)'), 'ASC')
                            ->orderBy(DB::raw('MONTH(created_at)'), 'ASC')
                            ->get();

                        // Initialize an array to hold the order counts for each month
                        $monthlyOrderCounts = [
                            'Jan' => 0,
                            'Feb' => 0,
                            'Mar' => 0,
                            'Apr' => 0,
                            'May' => 0,
                            'Jun' => 0,
                            'Jul' => 0,
                            'Aug' => 0,
                            'Sep' => 0,
                            'Oct' => 0,
                            'Nov' => 0,
                            'Dec' => 0
                        ];

                        // Populate the order counts for each month
                        foreach ($ordersCount as $order) {
                            $monthName = date('M', mktime(0, 0, 0, $order->month, 10));
                            $monthlyOrderCounts[$monthName] = $order->order_count;
                        }

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
                            'promotionsNew' => $promotionsNew,
                            'monthlyOrderCounts' => $monthlyOrderCounts,
                            'topProducts' => $topProducts,
                            'recommendedShops' => $recommendedShops
                        ]);

                    case "customer":
                        $customer = Auth::user();
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
