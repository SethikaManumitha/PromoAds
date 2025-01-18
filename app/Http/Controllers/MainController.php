<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Business;
use App\Models\User;
use App\Models\Promotion;

class MainController extends Controller
{
    //
    public function index()
    {
        $business = Business::all();

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
