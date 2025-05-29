<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('signin',[App\Http\Controllers\api\AuthController::class,'signin']);
Route::get('/twilio-check', function () {
    try {
        $twilio = new \Twilio\Rest\Client(
            config('services.twilio.sid'),
            config('services.twilio.token')
        );

        $message = $twilio->messages->create(
            '+13182178211', // test number
            [
                'from' => config('services.twilio.from'),
                'body' => 'Test message from Laravel'
            ]
        );

        return $message->sid;
    } catch (\Exception $e) {
        return $e->getMessage();
    }
});


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
// 
