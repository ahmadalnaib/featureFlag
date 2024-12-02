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
            __DIR__.'/database/migrations/2024_01_01_create_feature_flags_table.php' => database_path('migrations/2024_01_01_create_feature_flags_table.php'),
            __DIR__.'/resources/js/Pages/Admin/Features/Index.vue' => resource_path('js/Pages/Admin/Features/Index.vue'),
            __DIR__.'/Models/FeatureFlag.php' => app_path('Models/FeatureFlag.php'),
            __DIR__.'/Http/Controllers/FeatureFlagController.php' => app_path('Http/Controllers/FeatureFlagController.php'),
            __DIR__.'/Http/Controllers/Api/FeatureFlagController.php' => app_path('Http/Controllers/Api/FeatureFlagController.php'),
            __DIR__.'/routes/web.php' => base_path('routes/web.php'),
            __DIR__.'/routes/api_v1.php' => base_path('routes/api.php'),
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