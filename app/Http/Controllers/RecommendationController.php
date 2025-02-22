<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class RecommendationController extends Controller
{
    public function getRecommendations(Request $request, $user_id)
    {
        // API request to Flask
        $response = Http::get("https://model-production-5ace.up.railway.app/recommend/" . urlencode($user_id));

        if ($response->successful()) {
            $data = $response->json();
            $recommendedShops = $data['recommendations'] ?? [];
        } else {
            $recommendedShops = [];
        }

        // Return recommendations to the view
        return view('recommendations', compact('recommendedShops'));
    }
}
