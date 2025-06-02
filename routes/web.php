<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MigrationController;
use Illuminate\Support\Facades\Response;

Route::get('/migrate', [MigrationController::class, 'runAll']);
Route::get('/migrate-1', [MigrationController::class, 'runSpecific']);
Route::get('/clear', [MigrationController::class, 'clearAll']);

Route::get('/', function () {
    return view('welcome');
    // return "abc";
});
 
Route::get('/stream-info', function () {
    return response()->json([
        'appID' => env('ZEGO_APP_ID'),
        'appSign' => env('ZEGO_APP_SIGN'),
        'roomID' => 'Live-001', // ✅ same as Flutter liveID
        'userID' => 3333,
        'userName' => 'Viewer_63'
    ]);
});

Route::get('/viewer', function () {
    return response()->file(public_path('stream.html'));
});

Route::get('/zego-token', function () {
    $appID = intval(env('ZEGO_APP_ID'));
    $serverSecret = env('ZEGO_SERVER_SECRET');
    $userID = request('userID');

    if (!$serverSecret || !$userID) {
        return response()->json(['error' => 'Missing secret or userID'], 400);
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



Route::get('/zego-check', function () {
    if (env('ZEGO_APP_ID') && env('ZEGO_APP_SIGN')) {
        return response()->json(['status' => 'ok', 'message' => 'Zego credentials loaded']);
    } else {
        return response()->json(['status' => 'error', 'message' => 'Zego credentials missing']);
    }
});
