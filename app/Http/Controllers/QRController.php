<?php

namespace App\Http\Controllers;

use App\Models\About;
use App\Models\Banner;
use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use App\Models\Promotion;
use App\Models\Business;
use App\Models\Feedback;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\Http;

class QRController extends Controller
{
    // Get QR code
    public function getQRCode()
    {
        $userId = session('business_id');
        $url = env('APP_URL');

        $qrCodeData = $url . "/showpromo/{$userId}";

        $qrCode = QrCode::size(200)->generate($qrCodeData);

        return view('qrcode', compact('qrCode'));
    }

    public function showPromo(Request $request, $userId)
    {
        $category = $request->query('category');

        if ($category) {
            $promotions = Promotion::where('business_id', $userId)
                ->where('category', 'like', "%$category%")
                ->get();
        } else {
            $promotions = Promotion::where('business_id', $userId)->get();
        }

        $banner = Banner::where('shop_id', $userId)->get();
        $products = Product::where('shop_id', $userId)->get();
        $business = Business::where('id', $userId)->first();
        $about = About::where('shop_id', $userId)->first();
        $aboutImg = $about ? $about->image : null;
        if (!$business) {
            abort(404, "Business not found");
        }

        $user = User::where('name', $business->business_name)->first();
        $feedbacks = Feedback::where('promotion_id', $business->id)
            ->with('user')
            ->get();


        // Fetch recommendations from Flask API
        $response = Http::get("https://model-production-5ace.up.railway.app/recommend/" . urlencode($userId));

        if ($response->successful()) {
            $data = $response->json();
            $recommendedShops = $data['recommendations'] ?? [];
        } else {
            $recommendedShops = [];
        }



        return view('showpromotion', compact('userId', 'banner', 'aboutImg', 'products', 'promotions', 'business', 'user', 'feedbacks', 'recommendedShops'));
    }
}
