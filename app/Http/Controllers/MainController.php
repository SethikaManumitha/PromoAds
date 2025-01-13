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

        $promotions = Promotion::all();
        return view('index', compact('business', 'promotions'));
    }

    public function getIndexByCategory()
    {
        $business = Business::where();

        foreach ($business as $biz) {
            $biz->user = User::where('email', $biz->email)->first();
        }

        $promotions = Promotion::all();
        return view('index', compact('business', 'promotions'));
    }
}
