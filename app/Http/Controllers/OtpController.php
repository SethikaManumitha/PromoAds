<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OtpController extends Controller
{
    public function sendOtp(Request $request)
    {
        
        $phoneNumber = $request->input('phone');
        $otp = rand(100000, 999999);

        $basic  = new \Vonage\Client\Credentials\Basic(env('VONAGE_API_KEY'), env('VONAGE_API_SECRET'));
        $client = new \Vonage\Client($basic);

        
        $response = $client->sms()->send(
            new \Vonage\SMS\Message\SMS($phoneNumber, env('VONAGE_BRAND_NAME'), 'Your OTP is ' . $otp)
        );

        $message = $response->current();

        if ($message->getStatus() == 0) {
            
            session(['otp' => $otp, 'phone' => $phoneNumber]);
            //return redirect()->route('otpVerification');
            echo $otp . " " . $phoneNumber;
        } else {
            return response()->json(['error' => 'OTP sending failed.'], 500);
        }
    }
}
