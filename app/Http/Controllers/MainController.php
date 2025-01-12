<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Business;
use App\Models\Promotion;
use App\Models\User;

class MainController extends Controller
{
    //
    public function index()
    {
        $business = Business::all();

        foreach ($business as $biz) {
            $biz->user = User::where('email', $biz->email)->first();
        }
        $promotions = Promotion::all();
        return view('index', compact('business', 'promotions'));
    }
}
