<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MigrationController;
use Illuminate\Support\Facades\Response;

Route::get('/migrate', [MigrationController::class, 'runAll']);
Route::get('/migrate-1', [MigrationController::class, 'runSpecific']);
Route::get('/clear', [MigrationController::class, 'clearAll']);

Route::get('/viewer', function () {
    return response()->file(public_path('stream.html'));
});



// routes/web.php
Route::get('/zego-token', function () {
    $appID = 1173379578; // your app ID
    $serverSecret = '7094b1463e589f6c10d756d00a89648263426a00d725a02aadfb89dc553dc458'; // from Zego dashboard
    $userID = 333;

    if (!$userID) {
        return response()->json(['error' => 'Missing userID'], 400);
    }

    $expire = time() + 3600;
    $nonce = random_int(100000, 999999);

    $payloadArray = [
        'app_id' => $appID,
        'user_id' => $userID,
        'nonce' => $nonce,
        'expired' => $expire,
    ];

    $payload = json_encode($payloadArray);
    $signature = hash_hmac('sha256', $payload, $serverSecret, true);
    $token = base64_encode($signature) . '.' . base64_encode($payload);

    return response()->json(['token' => $token]);
});
