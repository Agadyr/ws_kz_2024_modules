<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class PoiServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton('PoiFactory', function ($app) {
            return new \App\Services\Poi\PoiFactory();
        });
    }


    public function boot()
    {
        //
    }
}
