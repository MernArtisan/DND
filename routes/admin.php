<?php

use Illuminate\Support\Facades\Route;

Route::prefix('admin')->name('admin.')->group(function () {
  Route::group(['middleware' => ['admin.guest']], function () {
    Route::get('login', [App\Http\Controllers\admin\AuthController::class, 'login'])->name('login');
    Route::post('authenticate', [App\Http\Controllers\admin\AuthController::class, 'authenticate'])->name('authenticate');
  });

  Route::group(['middleware' => ['admin.auth']], function () {
    Route::get('dashboard', [App\Http\Controllers\admin\DashboardControler::class, 'dashboard'])->name('dashboard');
    Route::post('logout', [App\Http\Controllers\admin\AuthController::class, 'logout'])->name('logout');

    Route::resource('/banner', App\Http\Controllers\admin\BannerController::class);
    Route::resource('/category', App\Http\Controllers\admin\CategoryController::class);
    Route::resource('/channel', App\Http\Controllers\admin\ChannelController::class);
    Route::resource('/user-streamer', App\Http\Controllers\admin\UserController::class);
    Route::post('/channel/toggle-status', [App\Http\Controllers\admin\ChannelController::class, 'toggleStatus'])->name('channel.toggleStatus');
    Route::get('/user-streamer-details', [App\Http\Controllers\admin\UserController::class, 'details'])->name('user-streamer.details');
    Route::post('/user-streamer/toggle-status', [App\Http\Controllers\admin\UserController::class, 'toggleStatus'])->name('user-streamer.toggleStatus');
    Route::get('/privacy-policy', [App\Http\Controllers\admin\ContentController::class, 'Privacy'])->name('privacy-policy');
    Route::put('/privacy-policy-update', [App\Http\Controllers\admin\ContentController::class, 'updatePrivacy'])->name('privacy-policy-update');

    Route::resource('/resource', App\Http\Controllers\admin\ContentController::class);

    Route::get('/terms-condition', [App\Http\Controllers\admin\ContentController::class, 'Terms'])->name('terms-condition');
    Route::put('/terms-condition-update', [App\Http\Controllers\admin\ContentController::class, 'updateTerms'])->name('terms-condition-update');
    Route::get('/streams', [App\Http\Controllers\admin\StreamController::class, 'Stream'])->name('streams');
    Route::resource('/subscription', App\Http\Controllers\admin\SubscriptionController::class);
    Route::resource('/articles', App\Http\Controllers\admin\ArticleController::class);
    Route::post('articles/delete-image', [App\Http\Controllers\admin\ArticleController::class, 'deleteImage'])->name('articles.deleteImage');
    Route::get('/admin-profile', [App\Http\Controllers\admin\UserController::class, 'showProfile'])->name('showProfile');
    Route::get('/edit-admin-profile', [App\Http\Controllers\admin\UserController::class, 'editProfile'])->name('editProfile');
    Route::put('/update-admin-profile', [App\Http\Controllers\admin\UserController::class, 'updateProfile'])->name('updateProfile');

    // Route::put('/update-admin-profile', [App\Http\Controllers\admin\UserController::class, 'updateProfile'])->name('updateProfile');

    Route::resource('/content', App\Http\Controllers\admin\ContentController::class);

    Route::resource('/testimonials', \App\Http\Controllers\admin\TestimoniController::class);
    Route::resource('/teams', \App\Http\Controllers\admin\TeamController::class);
    Route::get('/general-details', [App\Http\Controllers\admin\GeneralController::class, 'general'])->name('general.details');
    Route::get('/edit-general-details', [App\Http\Controllers\admin\GeneralController::class, 'edit'])->name('edit.general.details');
    Route::post('/update-general-details', [App\Http\Controllers\admin\GeneralController::class, 'update'])->name('update.general.details');

    Route::post('/newsletter-submit', [App\Http\Controllers\admin\NewsletterController::class, 'newsletter'])->name('newsletter.submit');
    Route::get('/newsletter', [App\Http\Controllers\admin\NewsletterController::class, 'index'])->name('newsletter.index');

    Route::get('/inquiries', [App\Http\Controllers\admin\InquiryController::class, 'index'])->name('inquiries.index');

  });
});
