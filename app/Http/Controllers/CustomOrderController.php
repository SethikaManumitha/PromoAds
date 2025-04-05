<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CustomOrder;
use App\Models\Loyalty;
use Illuminate\Support\Facades\Auth;

class CustomOrderController extends Controller
{

    //Store a newly created custom order.
    public function store(Request $request)
    {
        // Validate the form inputs
        $request->validate([
            'business_id' => 'required|exists:businesses,id',
            'description' => 'required|string|max:1000',
        ]);


        // Create the custom order
        CustomOrder::create([
            'user_id' => Auth::id(),
            'business_id' => $request->business_id,
            'description' => $request->description,
        ]);

        return back()->with('success', 'Custom order placed successfully!');
    }


    //Display a list of custom orders for the user
    public function index()
    {
        $customOrders = CustomOrder::where('business_id', session('business_id'))->get();
        return view('manageCustomOrders', compact('customOrders'));
    }
}
