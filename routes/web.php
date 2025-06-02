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

// Already exists
Route::get('/stream-info', function () {
    return response()->json([
        'appID' => env('ZEGO_APP_ID', 1173379578),
        'appSign' => env('ZEGO_APP_SIGN', '7094b1463e589f6c10d756d00a89648263426a00d725a02aadfb89dc553dc458'),
        'roomID' => 'streaming_001', // Must match Flutter app's roomID
        'userID' => 'viewer_' . rand(1000, 9999),
        'userName' => 'Viewer_' . rand(1, 100)
    ]);
});


Route::get('/viewer', function () {
    return response()->file(public_path('stream.html'));
});


Route::get('/zego-token', function () {
    $appID = intval(env('ZEGO_APP_ID'));
    $serverSecret = env('ZEGO_SERVER_SECRET'); // ✅ Add this in .env
    $userID = request('userID');
    $expire = time() + 3600; // valid for 1 hour
    $nonce = random_int(100000, 999999);

    $payload = json_encode([
        'app_id' => $appID,
        'user_id' => $userID,
        'nonce' => $nonce,
        'expired' => $expire,
    ]);

    openssl_sign($payload, $signature, $serverSecret, 'sha256');
    $token = base64_encode($signature) . '.' . base64_encode($payload);

    return Response::json(['token' => $token]);
});

Route::get('/zego-check', function () {
    if (env('ZEGO_APP_ID') && env('ZEGO_APP_SIGN')) {
        return response()->json(['status' => 'ok', 'message' => 'Zego credentials loaded']);
    } else {
        return response()->json(['status' => 'error', 'message' => 'Zego credentials missing']);
    }
});
