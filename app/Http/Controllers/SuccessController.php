<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use App\Models\User;

class SuccessController extends Controller
{
    public function generateQRCode()
    {
        $user = User::latest()->first();

        if (!$user) {
            return redirect()->back()->with('error', 'No user found.');
        }

        $userId = $user->id;
        $url = env('APP_URL');

        $qrCodeData = $url . "/showpromo/{$userId}";
        $qrCode = QrCode::size(200)->generate($qrCodeData);
        return view('signup.success', compact('qrCode'));
    }
}
