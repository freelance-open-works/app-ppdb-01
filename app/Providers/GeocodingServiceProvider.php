<?php

namespace App\Providers;

use App\Services\GeocodingService;
use Illuminate\Support\ServiceProvider;

class GeocodingServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton('geo', function ($app) {
            return new GeocodingService(config('services.opencage.key'));
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
