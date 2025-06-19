<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;

// Authenticate apis
// register
Route::post('/signup', [App\Http\Controllers\api\AuthController::class, 'signup']);
// login or  verifyIOTP
Route::post('/signin', [App\Http\Controllers\api\AuthController::class, 'signin']);
Route::post('/verify-otp', [App\Http\Controllers\api\AuthController::class, 'verifyOtp']);
// forgot password
Route::post('/forgot-password', [App\Http\Controllers\api\AuthController::class, 'sendPasswordResetOtp']);
Route::post('/verify-password-reset-otp', [App\Http\Controllers\api\AuthController::class, 'verifyResetOtp']);
Route::post('/reset-password', [App\Http\Controllers\api\AuthController::class, 'resetPassword']);

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
    Route::post('/streams/{id}/join', [App\Http\Controllers\api\StreamController::class, 'incrementViewer']);
    Route::get('/my-streams', [App\Http\Controllers\api\StreamController::class, 'myStreams']);
    Route::get('/stream-discover', [App\Http\Controllers\api\StreamController::class, 'discoverStreamWithChannels']);
    // Viewers Routes Here
    Route::get('/banners', [App\Http\Controllers\api\DiscoverController::class, 'banners']);
    Route::get('/highlights-channels', [App\Http\Controllers\api\DiscoverController::class, 'highlightsChannels']);
    Route::get('/hightlights-all', [App\Http\Controllers\api\DiscoverController::class, 'hightlightsAll']);
    Route::get('/live-streams', [App\Http\Controllers\api\DiscoverController::class, 'liveStreams']);
    Route::get('/channels-all', [App\Http\Controllers\api\DiscoverController::class, 'channelsAll']);
    Route::post('/save-video', [App\Http\Controllers\api\DiscoverController::class, 'saveVideo']);
    Route::get('/saved-videos', [App\Http\Controllers\api\DiscoverController::class, 'getMySavedVideos']);
    Route::post('/highlight-count-increment', [App\Http\Controllers\api\DiscoverController::class, 'incrementHighlightView']);

    Route::get('/hightlights-specific/{id}', [App\Http\Controllers\api\DiscoverController::class, 'hightlightsSpecific']);
    Route::post('/hightlights-specific/{id}/comment', [App\Http\Controllers\api\DiscoverController::class, 'addComment']);
    Route::post('/highlights-specific/{id}/like-unlike', [App\Http\Controllers\api\DiscoverController::class, 'likeUnlikeHighlight']);
});
