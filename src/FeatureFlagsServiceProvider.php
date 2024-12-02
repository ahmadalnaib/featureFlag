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
        ], 'feature-flags-config');
     
        $this->publishes([
            __DIR__.'/database/migrations/2024_01_01_create_feature_flags_table.php' => database_path('migrations/2024_01_01_create_feature_flags_table.php'),
        ], 'feature-flags-migrations');
   
        $this->publishes([
            __DIR__.'/resources/js/Pages/Admin/Featuress/Index.vue' => resource_path('js/Pages/Admin/Featuress/Index.vue'),
        ], 'feature-flags-views');

        $this->publishes([
            __DIR__.'/Models/FeatureFlag.php' => app_path('Models/FeatureFlag.php'),
        ], 'feature-flags-models');


        
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