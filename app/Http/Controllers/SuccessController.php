<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class SuccessController extends Controller
{
    public function generateQRCode()
    {
        $qrCodeData = "https://www.google.com/";

        $qrCode = QrCode::size(200)->generate($qrCodeData);

        return view('success', compact('qrCode'));
    }
}