<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Business;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Cart;
use App\Models\Promotion;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Spatie\Analytics\Facades\Analytics;
use Spatie\Analytics\Period as AnalyticsPeriod;

class BusinessController extends Controller
{


    public function getBusinessData($businessId)
    {
        $totalViews = DB::table('promo_views')
            ->where('business_id', $businessId)
            ->sum('views');

        $uniqueVisitorsCount = DB::table('promo_views')
            ->where('business_id', $businessId)
            ->distinct('visitor_id')
            ->count('visitor_id');

        $carts = Cart::with(['promotion.business', 'user'])
            ->whereHas('promotion', function ($query) use ($businessId) {
                $query->where('business_id', $businessId);
            })
            ->get();

        $analyticsData = Analytics::fetchVisitorsAndPageViews(AnalyticsPeriod::days(7));

        $engagementRate = $uniqueVisitorsCount > 0 ? ($totalViews / $uniqueVisitorsCount) * 100 : 0;

        $groupedCarts = $carts->groupBy('user_id')->map(function ($group) {
            return $group->groupBy('promotion_id')->map(function ($promotionGroup) {
                return [
                    'promotion' => $promotionGroup->first()->promotion,
                    'total_quantity' => $promotionGroup->sum('quantity'),
                    'user' => $promotionGroup->first()->user,
                ];
            });
        });

        return [
            'totalViews' => $totalViews,
            'uniqueVisitorsCount' => $uniqueVisitorsCount,
            'engagementRate' => $engagementRate,
            'groupedCarts' => $groupedCarts,
        ];
    }

    public function showDashboard()
    {
        $businessId = session('business_id');

        if ($businessId) {
            $businessData = $this->getBusinessData($businessId);

            $promotions = Promotion::where('business_id', $businessId)->take(6)->get();

            $ordersCount = DB::table('orders')
                ->select(DB::raw('MONTH(created_at) as month'), DB::raw('YEAR(created_at) as year'), DB::raw('COUNT(*) as order_count'))
                ->where('shop_id', $businessId)
                ->groupBy(DB::raw('YEAR(created_at)'), DB::raw('MONTH(created_at)'))
                ->orderBy(DB::raw('YEAR(created_at)'), 'ASC')
                ->orderBy(DB::raw('MONTH(created_at)'), 'ASC')
                ->get();

            $monthlyOrderCounts = array_fill_keys([
                'Jan',
                'Feb',
                'Mar',
                'Apr',
                'May',
                'Jun',
                'Jul',
                'Aug',
                'Sep',
                'Oct',
                'Nov',
                'Dec'
            ], 0);

            foreach ($ordersCount as $order) {
                $monthName = date('M', mktime(0, 0, 0, $order->month, 10));
                $monthlyOrderCounts[$monthName] = $order->order_count;
            }

            $response = Http::get("https://model-production-5ace.up.railway.app/recommend/" . urlencode($businessId));

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

            $topProducts = Cart::select('product_id', DB::raw('SUM(quantity) as total_quantity'))
                ->whereHas('promotion', function ($query) use ($businessId) {
                    $query->where('business_id', $businessId);
                })
                ->groupBy('product_id')
                ->orderByDesc('total_quantity')
                ->take(3)
                ->with('promotion')
                ->get();

            return view('admin.businessDashboard', [
                'uniqueVisitorsCount' => $businessData['uniqueVisitorsCount'],
                'totalViews' => $businessData['totalViews'],
                'engagementRate' => $businessData['engagementRate'],
                'groupedCarts' => $businessData['groupedCarts'],
                'promotionsNew' => $promotions,
                'monthlyOrderCounts' => $monthlyOrderCounts,
                'topProducts' => $topProducts,
                'recommendedShops' => $recommendedShops
            ]);
        } else {
            return redirect()->route('login')->withErrors('Business not found in session.');
        }
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


    public function changeBusinessProfile(Request $request, $id)
    {
        // Validate input
        $validated = $request->validate([
            'profile_picture' => 'required|mimes:png,jpg,jpeg,webp|max:2048',
        ]);

        $user = User::find($id);

        if (!$user) {
            return redirect()->back()->with('error', 'User not found.');
        }

        $file = $request->file('profile_picture');
        $extension = $file->getClientOriginalExtension();
        $path = 'uploads/profile/';
        $filename = time() . "_" . $user->id . "." . $extension;
        $file->move(public_path($path), $filename);

        if ($user->profile && file_exists(public_path($user->profile))) {
            unlink(public_path($user->profile));
        }

        $user->profile = $path . $filename;
        $user->save();

        return redirect()->back()->with('success', 'Profile picture updated successfully!');
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
        $business = Business::create([
            'business_name' => $validated['business_name'],
            'business_type' => $validated['business_type'],
            'description' => $validated['descript'],
            'email' => $validated['email'],
            'phone_number' => $validated['phone_number'],
            'password' => bcrypt($validated['password']),
        ]);

        User::create([
            'name' => $validated['business_name'],
            'email' => $validated['email'],
            'phone' => $validated['phone_number'],
            'password' => bcrypt($validated['password']),
            'role' => 'business',
            'status' => '0'
        ]);

        return redirect()->route('genQR')->with('success', 'Business registered successfully!');
    }
}
