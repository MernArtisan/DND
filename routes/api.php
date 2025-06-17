<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;

// Authenticate apis
// Route::post('/signup', [App\Http\Controllers\api\AuthController::class, 'signup']);
Route::post('/signup',[App\Http\Controllers\api\AuthController::class, 'signup']);
Route::post('/signin', [App\Http\Controllers\api\AuthController::class, 'signin']);
Route::post('/verify-otp', [App\Http\Controllers\api\AuthController::class, 'verifyOtp']);
// Middleware To Protect Over Auth Routes
Route::middleware(['auth:sanctum'])->group(function () {
    // Profile Routes
    Route::post('/logout', [App\Http\Controllers\api\ProfileController::class, 'logout']);
    Route::post('/profile', [App\Http\Controllers\api\ProfileController::class, 'Updateprofile']);
    Route::get('/profile', [App\Http\Controllers\api\ProfileController::class, 'profile']);
    Route::get('/terms', [App\Http\Controllers\api\ProfileController::class, 'terms']);
    Route::get('/privacy', [App\Http\Controllers\api\ProfileController::class, 'privacy']);
    Route::delete('/delete-account', [App\Http\Controllers\api\ProfileController::class, 'deleteAccount']);
    // Channel Routes
    Route::get('/my-channels', [App\Http\Controllers\api\ChannelController::class, 'index']);
    Route::post('/channel/create', [App\Http\Controllers\api\ChannelController::class, 'create']);
    Route::post('/channel/{id}/update', [App\Http\Controllers\api\ChannelController::class, 'update']);
    Route::delete('/channel/{id}/delete', [App\Http\Controllers\api\ChannelController::class, 'delete']);

    // Highlight Routes
    Route::apiResource('/highlights', App\Http\Controllers\api\HighlightController::class);
    Route::post('/highlight/{id}/update', [App\Http\Controllers\api\HighlightController::class, 'update']);
    // Stream Start Routes
    Route::get('/category', [App\Http\Controllers\api\StreamController::class, 'category']);
    Route::post('/stream-add', [App\Http\Controllers\api\StreamController::class, 'addStream']);
    Route::post('/streams/{id}/changeStatus', [App\Http\Controllers\api\StreamController::class, 'toggleStreamStatus']);
    Route::get('/streams-top', [App\Http\Controllers\api\StreamController::class, 'topStreams']);

});
