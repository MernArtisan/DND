<?php

namespace App\Http\Controllers\web;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Mail\ResetPasswordMail;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;

class ForgotPasswordController extends Controller
{

    public function showLinkRequestForm()
    {
        return view('web.auth.forgot-password');
    }

    public function sendResetLinkEmail(Request $request)
    {
        try {
            $request->validate(['email' => 'required|email|exists:users,email']);

            $token = Str::random(64);
            $email = $request->email;

            DB::table('password_resets')->updateOrInsert(
                ['email' => $email],
                ['token' => $token, 'created_at' => Carbon::now()]
            );

            $link = route('password.reset', $token) . '?email=' . urlencode($email);
            Mail::to($request->email)->send(new ResetPasswordMail($link));

            return back()->with('success', 'We have emailed your password reset link!');
        } catch (\Throwable $th) {

            return back()->with('error', $th->getMessage());
        }
    }
}
