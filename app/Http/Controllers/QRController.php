<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use App\Models\Promotion;
use App\Models\Business;
use App\Models\User;

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

        $business = Business::where('id', $userId)->first();

        if (!$business) {
            abort(404, "Business not found");
        }


        $user = User::where('name', $business->business_name)->first();
        return view('showpromotion', compact('userId', 'promotions', 'business', 'user'));
    }
}
