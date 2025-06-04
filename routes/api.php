<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;

// Authenticate apis
Route::post('signup', [App\Http\Controllers\api\AuthController::class, 'signup']);
Route::post('signin', [App\Http\Controllers\api\AuthController::class, 'signin']);
Route::post('verify-otp', [App\Http\Controllers\api\AuthController::class, 'verifyOtp']);
// Middleware To Protect Over Auth Routes
Route::middleware(['auth:sanctum'])->group(function () {
    // Profile Routes
    Route::post('logout', [App\Http\Controllers\api\ProfileController::class, 'logout']);
    Route::post('profile', [App\Http\Controllers\api\ProfileController::class, 'Updateprofile']);
    Route::get('profile', [App\Http\Controllers\api\ProfileController::class, 'profile']);
    // Channel Routes
    Route::post('channel/create', [App\Http\Controllers\api\ChannelController::class, 'create']);
});

Route::get('zego-token', function (Request $request) {
    $appID = intval(env('ZEGO_APP_ID')); // ✅ 1269365093
    $serverSecret = env('ZEGO_SERVER_SECRET'); // ✅ 5eb0af489d7d12bce51c1746097e667d

    $userID = $request->query('userID'); // ✅ GET se userID lo
    $roomID = $request->query('liveID'); // ✅ GET se roomID lo

    if (!$userID || !$roomID) {
        return response()->json(['error' => 'Missing userID or roomID'], 400);
    }

    $expire = time() + 3600;
    $nonce = random_int(100000, 999999);

    $payload = json_encode([
        'app_id' => $appID,
        'user_id' => $userID,
        'room_id' => $roomID,
        'nonce' => $nonce,
        'expired' => $expire,
    ]);

    $signature = hash_hmac('sha256', $payload, $serverSecret, true);
    $token = base64_encode($signature) . '.' . base64_encode($payload);

    return response()->json(['token' => $token]);
});
