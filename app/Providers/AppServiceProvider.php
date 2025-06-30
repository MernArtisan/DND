<?php

namespace App\Providers;

use App\Models\Content;
use App\Models\General;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot()
    {
        $cms_content = Content::whereNotIn("id", [1, 2])->get();
        $general_content = General::first();
        View::share('general_content', $general_content);
        View::share('cms_content', $cms_content);
    }
}
