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

    public function showPromo(Request $request, $userId)
    {
        $business = User::where('id', $userId)->first();

        if (!$business) {
            return redirect()->back()->with('error', 'Business not found.');
        }

        $businessName = $business->name;
        $category = $request->query('category');

        if ($category) {
            $promotions = Promotion::where('business', $businessName)
                ->where('category', 'like', "%$category%")
                ->get();
        } else {
            $promotions = Promotion::where('business', $businessName)->get();
        }

        return view('showpromotion', compact('userId', 'promotions'));
    }
}
