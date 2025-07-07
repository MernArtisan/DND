<?php

namespace App\Providers;

use App\Models\User;
use App\Models\Content;
use App\Models\General;
use App\Models\Inquiry;
use App\Models\Newsletter;
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

        $inquiries_unread = Inquiry::where('is_read', 0)->count();

        $newsletter = Newsletter::count();

        View::share('general_content', $general_content);
        View::share('cms_content', $cms_content);

        View::share('inquiries_unread', $inquiries_unread);

        View::share('newsletter', $newsletter);


    }
}
