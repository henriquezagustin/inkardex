<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Validator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {        
        //Add this custom validation rule.
        Validator::extend('alpha_spaces', function ($attribute, $value) {
            // This will only accept alpha and spaces.
            // If you want to accept hyphens use: /^[\pL\s-]+$/u.
            return preg_match('/^[\pL\s]+$/u', $value);
        });

        //Add this custom validation rule.
        Validator::extend('alpha_num_spaces', function ($attribute, $value) {
            // This will only accept alpha, numbers, dash, forward slash and spaces.
            // If you want to accept hyphens use: /^[\pL\s-]+$/u.
            return preg_match('/(^[A-Za-z0-9\-\/ ]+$)+/', $value);
        });        
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
