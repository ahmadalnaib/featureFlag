<?php

namespace YourName\LaravelFeatureFlags\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class AppendFeatureFlagsRoutes extends Command
{
    protected $signature = 'feature-flags:append-routes';
    protected $description = 'Append feature flags routes to the application\'s routes/web.php file';

    public function handle()
    {
        $packageRoutes = __DIR__ . '/../../routes/web.php';
        $appRoutes = base_path('routes/web.php');

        if (File::exists($packageRoutes)) {
            $routesContent = File::get($packageRoutes);
            // Remove the <?php tag if it exists
            $routesContent = preg_replace('/<\?php\s*/', '', $routesContent);
            File::append($appRoutes, "\n" . $routesContent);
            $this->info('Feature flags routes have been appended to routes/web.php');
        } else {
            $this->error('Package routes file not found.');
        }
    }
}