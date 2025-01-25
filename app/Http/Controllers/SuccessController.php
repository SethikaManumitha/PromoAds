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

        if ($user->role === 'business') {
            return view('admin.businessCreated', compact('qrCode', 'user'));
        } elseif ($user->role === 'driver') {
            return view('admin.driverCreated', compact('user'));
        }

        // Redirect if role is not recognized
        return redirect()->back()->with('error', 'User role not recognized.');
    }
}
