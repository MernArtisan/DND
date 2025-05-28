<?php

use Illuminate\Support\Facades\Route;
Route::get('/run-migrate', function () {
    if (request('key') !== 'secret-key') abort(403);
    \Illuminate\Support\Facades\Artisan::call('migrate', ['--force' => true]);
    return 'Migrations done!';
});

Route::get('/', function () { 
    return view('welcome'); 
    // return "abc";
});
