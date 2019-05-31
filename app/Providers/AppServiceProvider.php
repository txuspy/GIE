<?php

namespace App\Providers;


use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Validator::extend('phone_number', function($attribute, $value, $parameters)
        {
            return substr($value, 0, 1) == '+';
        });
        \Debugbar::disable();
    }

    /**
     * Register any application services.
     *
     * @return void
     */

    public function register()
    {
        $this->app->bind('path.public', function() {
            return base_path('html');
        });
    }
}
