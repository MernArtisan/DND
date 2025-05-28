<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('signin',[App\Http\Controllers\api\AuthController::class,'signin']);


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
// 
