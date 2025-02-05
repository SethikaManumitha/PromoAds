<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Business;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Cart;
use Illuminate\Support\Facades\DB;
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
        // Calculate Engagement Rate
        if ($uniqueVisitorsCount > 0) {
            $engagementRate = ($totalViews / $uniqueVisitorsCount) * 100;
        } else {
            $engagementRate = 0;
        }

        $groupedCarts = $carts->groupBy('user_id')->map(function ($group) {
            return $group->groupBy('promotion_id')->map(function ($promotionGroup) {
                return [
                    'promotion' => $promotionGroup->first()->promotion,
                    'total_quantity' => $promotionGroup->sum('quantity'),
                    'user' => $promotionGroup->first()->user, // Include user details
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


    // Show Business Dashboard
    public function showDashboard()
    {
        $businessId = session('business_id');

        if ($businessId) {
            // Call the getBusinessData method to fetch the required data
            $businessData = $this->getBusinessData($businessId);

            return view('admin.businessDashboard', [
                'uniqueVisitorsCount' => $businessData['uniqueVisitorsCount'],
                'totalViews' => $businessData['totalViews'],
                'engagementRate' => $businessData['engagementRate'],
                'groupedCarts' => $businessData['groupedCarts'],
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
