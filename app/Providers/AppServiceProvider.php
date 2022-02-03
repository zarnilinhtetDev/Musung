<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // URL::forceScheme('https');   ///// Make Heroku to force HTTPS (HTTP mix content error)
        Blade::if('admin', function () {
            return Auth::user()->role == 0;
        });
        Blade::if('operator', function () {
            return Auth::user()->role == 1;
        });
        Blade::if('line_manager', function () {
            return Auth::user()->role == 2;
        });
    }
}
