<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Business;
use App\Models\User;
use App\Models\Promotion;

class MainController extends Controller
{
    //
    public function index(Request $request)
    {
        $business_type = $request->query('business_type');
        if ($business_type) {
            $business = Business::where('business_type', $business_type)->get();
        } else {
            $business = Business::all();
        }

        foreach ($business as $biz) {
            $biz->user = User::where('email', $biz->email)->first();
        }

        $promotions = Promotion::with('business')
            ->get()
            ->map(function ($promotion) {
                $promotion->discount_rate = (($promotion->price - $promotion->dis_price) / $promotion->price) * 100;
                return $promotion;
            })
            ->sortByDesc('discount_rate');
        return view('index', compact('business', 'promotions'));
    }
}
