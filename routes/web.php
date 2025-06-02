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

// routes/api.php
Route::get('/stream-info', function () {
    return response()->json([
        'appID' => env('ZEGO_APP_ID'),
        'appSign' => env('ZEGO_APP_SIGN'),
        'userID' => 'user_' . rand(1000, 9999),
        'userName' => 'User ' . rand(1, 100),
        'roomID' => 'stream_002',
    ]);
});
Route::get('/zego-check', function () {
    if (env('ZEGO_APP_ID') && env('ZEGO_APP_SIGN')) {
        return response()->json(['status' => 'ok', 'message' => 'Zego credentials loaded']);
    } else {
        return response()->json(['status' => 'error', 'message' => 'Zego credentials missing']);
    }
});

// web.php
Route::get('/stream', function () {
    return response()->file(public_path('stream.html'));
});

