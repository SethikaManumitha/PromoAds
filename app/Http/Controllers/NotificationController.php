<?php

namespace App\Http\Controllers;

use App\Models\Loyalty;
use Illuminate\Http\Request;
use App\Models\Notification;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    //
    public function sendRequest(Request $request, $userId)
    {
        $business = Auth::user();

        $message = "Dear valued customer, we appreciate your support! Become a loyalty customer of {$business->name} to enjoy exclusive benefits and rewards!";


        $notification = new Notification([
            'user_id' => $userId,
            'business_id' => $business->id,
            'notification' => $message,
        ]);

        $notification->save();

        return redirect()->back()->with('success', 'Notification sent successfully.');
    }



    public function confirm($id)
    {
        $notification = Notification::findOrFail($id);
        $user = Auth::user();

        $exists = Loyalty::where('user_id', $user->id)
            ->where('business_id', $notification->business_id)
            ->exists();

        if (!$exists) {
            Loyalty::create([
                'user_id' => $user->id,
                'business_id' => $notification->business_id,
            ]);
        }

        return back()->with('success', 'You are now a loyalty customer!');
    }

    // Get user notifications
    public function getUserNotifications()
    {
        $user = Auth::user();

        // Fetch notifications for the logged-in user
        $notifications = Notification::where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->get();

        // Return a view with the notifications or JSON response
        return view('notification', compact('notifications'));
    }
}
