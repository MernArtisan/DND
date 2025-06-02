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
 
define('ZEGO_APP_ID', 1173379578);
define('ZEGO_APP_SIGN', '7094b1463e589f6c10d756d00a89648263426a00d725a02aadfb89dc553dc458');
define('ZEGO_SERVER_SECRET', '2ebaabb5af512d34bc2e48d106d4c264');

// Main viewer page
Route::get('/viewer', function () {
    return response()->file(public_path('stream.html'));
});

// Stream information endpoint
Route::get('/stream-info', function () {
    return response()->json([
        'appID' => ZEGO_APP_ID,
        'appSign' => ZEGO_APP_SIGN,
        'roomID' => 'Live-001',
        'userID' => 'viewer_'.rand(1000, 9999),
        'userName' => 'Viewer_'.rand(100, 999)
    ]);
});
Route::get('/zego-token', function () {
    $appID = 1173379578;
    $serverSecret = '2ebaabb5af512d34bc2e48d106d4c264';
    $userID = request('userID', 'viewer_'.rand(1000, 9999));

    // Ensure timestamp is in seconds
    $expire = time() + 3600;
    $nonce = random_int(100000, 999999);

    $payload = json_encode([
        'app_id' => $appID,
        'user_id' => $userID,
        'nonce' => $nonce,
        'expired' => $expire,
    ]);

    // Double-check the hash_hmac parameters
    $signature = hash_hmac('sha256', $payload, $serverSecret, true);
    
    // Verify encoding
    $token = base64_encode($signature).'.'.base64_encode($payload);
    
    return response()->json([
        'token' => $token,
        'userID' => $userID,
        'generated_at' => time(),
        'expires_at' => $expire
    ]);
});

// Test endpoint for token verification
Route::get('/test-token', function () {
    $userID = 'test_user_'.rand(1000, 9999);
    $tokenUrl = url('/zego-token?userID='.$userID);
    $tokenResponse = file_get_contents($tokenUrl);
    
    return response()->json([
        'test_user' => $userID,
        'token_response' => json_decode($tokenResponse),
        'verification' => 'Token generated successfully'
    ]);
});