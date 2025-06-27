<?php

namespace App\Providers;

use App\Models\Content;
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
        View::share('cms_content', $cms_content);
    }
}
