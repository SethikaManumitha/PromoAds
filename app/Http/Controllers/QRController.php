<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use App\Models\Promotion;
use App\Models\User;

class QRController extends Controller
{
    // Get QR code
    public function getQRCode()
    {
        $userId = session('user_id');
        $url = env('APP_URL');

        $qrCodeData = $url . "/showpromo/{$userId}";

        $qrCode = QrCode::size(200)->generate($qrCodeData);

        return view('qrcode', compact('qrCode'));
    }

    public function showPromo($userId)
    {
        $business = User::where('id', $userId)->first();

        if (!$business) {
            return redirect()->back()->with('error', 'Business not found.');
        }
        $businessName = $business->name;
        $promotions = Promotion::where('business', $businessName)->get();
        return view('showpromotion', compact('promotions'));
    }
}
