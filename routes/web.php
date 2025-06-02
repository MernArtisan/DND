<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MigrationController;



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
        'appID' => env('ZEGO_APP_ID'),
        'appSign' => env('ZEGO_APP_SIGN'),
        'userID' => 'user_viewer_' . rand(1000, 9999),
        'userName' => 'Viewer_' . rand(1, 100),
        'roomID' => 'stream_001',
    ]);
});


Route::get('/viewer', function () {
    return response()->file(public_path('stream.html'));
});


Route::get('/zego-check', function () {
    if (env('ZEGO_APP_ID') && env('ZEGO_APP_SIGN')) {
        return response()->json(['status' => 'ok', 'message' => 'Zego credentials loaded']);
    } else {
        return response()->json(['status' => 'error', 'message' => 'Zego credentials missing']);
    }
});
