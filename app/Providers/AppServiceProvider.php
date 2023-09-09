<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

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
        // For Restrict Host Header Application
        // Only Allowed For Host Bellow
        $allowed_host = array('komens.bappenas.go.id', 'dev8.bappenas.go.id');
        // $allowed_host = array('dev8.bappenas.go.id');

        if (!isset($_SERVER['HTTP_HOST']) || !in_array($_SERVER['HTTP_HOST'], $allowed_host)) 
        {
            abort(404);
            exit;
        }
    }
}
