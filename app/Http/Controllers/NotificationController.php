<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notification;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    //
    public function send(Request $request, $userId)
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
