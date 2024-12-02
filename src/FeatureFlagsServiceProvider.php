<?php

namespace YourName\LaravelFeatureFlags;

use Illuminate\Support\ServiceProvider;

class FeatureFlagServiceProvider extends ServiceProvider
{
    public function boot()
    {
        // Load migrations from the package
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');

        // Load routes from the package
        $this->loadRoutesFrom(__DIR__.'/../routes/web.php');

        // Load views from the package
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'feature-flag');

        // Publish configuration file
        $this->publishes([
            __DIR__.'/../config/feature-flags.php' => config_path('feature-flags.php'),
        ], 'feature-flags-config');

        // Publish migrations
        $this->publishes([
            __DIR__.'/../database/migrations/' => database_path('migrations')
        ], 'feature-flags-migrations');

        // Publish views
        $this->publishes([
            __DIR__.'/../resources/views' => resource_path('views/vendor/feature-flag')
        ], 'feature-flags-views');

        // Publish controllers (if needed)
        $this->publishes([
            __DIR__.'/../Http/Controllers' => app_path('Http/Controllers/Vendor/FeatureFlag')
        ], 'feature-flags-controllers');
    }

    public function register()
    {
        //
    }
}