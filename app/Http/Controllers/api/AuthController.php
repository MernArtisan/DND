<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use app\Services\TwilioService;

class AuthController extends Controller
{
    public function signin(Request $request, TwilioService $twilio)
    {
        $request->validate([
            'login_type' => 'required|in:email,phone',
            'value' => 'required|string',
        ]);

        $field = $request->login_type;
        $value = $request->value;

        $user = User::where($field, $value)->first();

        if (!$user) {
            $user = User::create([
                $field => $value,
                'name' => 'Guest User',
            ]);
        }

        $otp = rand(100000, 999999);

        DB::table('user_otps')->updateOrInsert(
            ['user_id' => $user->id],
            ['otp' => $otp, 'created_at' => now()]
        );

        if ($field === 'email') {
            Mail::raw("Your OTP is: $otp", function ($msg) use ($user) {
                $msg->to($user->email)->subject('Your OTP Code');
            });
        } else {
            $twilio->sendSMS($user->phone, "Your OTP is: $otp");
        }

        return response()->json([
            'status' => true,
            'message' => 'OTP sent successfully.',
            'medium' => $field,
            'otp' => $otp // ⚠️ For testing only — remove in production
        ]);
    }

    public function verifyOtp(Request $request)
    {
        $request->validate([
            'login_type' => 'required|in:email,phone',
            'value' => 'required|string',
            'otp' => 'required|string',
        ]);

        $field = $request->login_type;
        $value = $request->value;

        $user = User::where($field, $value)->first();

        if (!$user) {
            return response()->json(['status' => false, 'message' => 'User not found']);
        }

        $record = DB::table('user_otps')->where('user_id', $user->id)->first();

        if (!$record || $record->otp !== $request->otp) {
            return response()->json(['status' => false, 'message' => 'Invalid OTP']);
        }

        DB::table('user_otps')->where('user_id', $user->id)->delete();

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'status' => true,
            'message' => 'Login successful',
            'token' => $token,
            'user' => $user
        ]);
    }
}
