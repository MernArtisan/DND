<?php

use Illuminate\Support\Facades\Route;

Route::get('/migrate', [\App\Http\Controllers\MigrationController::class, 'runAll']);
Route::get('/migrate-1', [\App\Http\Controllers\MigrationController::class, 'runSpecific']);
Route::get('/clear', [\App\Http\Controllers\MigrationController::class, 'clearAll']);

Route::get('/viewer', function () {
    return response()->file(public_path('stream.html'));
});


Route::get('/', [App\Http\Controllers\web\HomeController::class, 'index'])->name('home.index');
Route::get('/login', [App\Http\Controllers\web\AuthController::class, 'login'])->name('login.index');
ROute::post('/authenticate', [App\Http\Controllers\web\AuthController::class, 'authenticate'])->name('login.authenticate');
Route::get('/signup', [App\Http\Controllers\web\AuthController::class, 'signup'])->name('signup.index');
Route::get('/verify-otp', [App\Http\Controllers\web\AuthController::class, 'verifyOtp'])->name('verifyOtp.index');
Route::get('/channels', [App\Http\Controllers\web\ChannelController::class, 'Channels'])->name('Channels.index');
Route::get('/pricing', [App\Http\Controllers\web\PricingController::class, 'Pricing'])->name('Pricing.index');
Route::get('/news', [App\Http\Controllers\web\NewsController::class, 'index'])->name('news.index');
Route::get('/news-details/{slug}', [App\Http\Controllers\web\NewsController::class, 'details'])->name('news.details');
Route::get('/staff', [App\Http\Controllers\web\StaffController::class, 'index'])->name('staff.index');
Route::get('/contact', [App\Http\Controllers\web\ContactController::class, 'index'])->name('contact.index');
Route::get('/corporate-sponsors', [App\Http\Controllers\web\DiscoverController::class, 'corporateSponsors'])->name('corporateSponsors.index');
Route::get('/live-streams', [App\Http\Controllers\web\DiscoverController::class, 'liveStreams'])->name('liveStreams.index');
Route::get('/terms', [App\Http\Controllers\web\DiscoverController::class, 'terms'])->name('terms.index');
Route::get('/privacy', [App\Http\Controllers\web\DiscoverController::class, 'privacy'])->name('privacy.index');
Route::post('/submit-inquiry', [App\Http\Controllers\web\ContactController::class, 'inquiry'])->name('inquiry.submit');
Route::post('/verify-otp', [App\Http\Controllers\web\AuthController::class, 'verifyOtpSubmit'])->name('verifyOtp.submit');
Route::post('/signup-submit', [App\Http\Controllers\web\AuthController::class, 'signupSubmit'])->name('signup.submit');
Route::post('/resend-otp', [App\Http\Controllers\web\AuthController::class, 'resendOtp'])->name('resend.otp');


Route::post('/newsletter-submit', [App\Http\Controllers\admin\NewsletterController::class, 'newsletter'])->name('newsletter.submit');


Route::post('/logout', [App\Http\Controllers\web\AuthController::class, 'logout'])->name('logout');

Route::get('forgot-password', [App\Http\Controllers\web\ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('forgot-password', [App\Http\Controllers\web\ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('reset-password/{token}', [App\Http\Controllers\web\ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('reset-password', [App\Http\Controllers\web\ResetPasswordController::class, 'reset'])->name('password.update');

// Route::post('reset-password', [App\Http\Controllers\web\ResetPasswordController::class, 'reset'])->name('password.update');


require __DIR__ . '/admin.php';
