<?php
namespace YourName\LaravelFeatureFlags;

use Illuminate\Support\ServiceProvider;
use YourName\LaravelFeatureFlags\Console\Commands\AppendFeatureFlagsRoutes;

class FeatureFlagsServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadMigrationsFrom(__DIR__.'/database/migrations');
        $this->loadRoutesFrom(__DIR__.'/routes/web.php');
        
        $this->publishes([
            __DIR__.'/config/feature-flags.php' => config_path('feature-flags.php'),
            __DIR__.'/database/migrations/2024_12_31_235959_create_feature_flags_table.php' => database_path('migrations/2024_12_31_235959_create_feature_flags_table.php'),
            __DIR__.'/Http/Controllers/FeatureFlagController.php' => app_path('Http/Controllers/FeatureFlagController.php'),
            __DIR__.'/Http/Controllers/Api/V1/FeatureFlagController.php' => app_path('Http/Controllers/Api/V1/FeatureFlagController.php'),
        ], 'feature-flags');
    }

    public function register()
    {
        $this->app->singleton('feature-flags', function() {
            return new FeatureFlags();
        });

        if ($this->app->runningInConsole()) {
            $this->commands([
                AppendFeatureFlagsRoutes::class,
            ]);
        }
    }
}