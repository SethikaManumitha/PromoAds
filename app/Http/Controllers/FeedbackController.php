<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Feedback;
use Illuminate\Support\Facades\Auth;

class FeedbackController extends Controller
{
    /**
     * Store feedback.
     */
    public function store(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Please log in to submit feedback.');
        }

        // Validate form input
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'required|string|max:500',
            'promotion_id' => 'required|exists:promotion,id',
        ]);

        // Save feedback to the database
        Feedback::create([
            'user_id' => $request->user()->id,
            'promotion_id' => $request->promotion_id,
            'rating' => $request->rating,
            'comment' => $request->comment,
        ]);

        // Redirect back with success message
        return back()->with('success', 'Thank you for your feedback!');
    }
}
