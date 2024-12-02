<?php

namespace YourName\LaravelFeatureFlags\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class AppendFeatureFlagsRoutes extends Command
{
    protected $signature = 'feature-flags:append-routes';
    protected $description = 'Append feature flags routes to the application\'s routes/web.php and routes/api.php files';

    public function handle()
    {
        $this->appendRoutes(__DIR__ . '/../../routes/web.php', base_path('routes/web.php'));
        $this->appendRoutes(__DIR__ . '/../../routes/api_v1.php', base_path('routes/api_v1.php'));
    }

    protected function appendRoutes($packageRoutes, $appRoutes)
    {
        if (File::exists($packageRoutes)) {
            $routesContent = File::get($packageRoutes);
            // Remove the <?php tag if it exists
            $routesContent = preg_replace('/<\?php\s*/', '', $routesContent);
            File::append($appRoutes, "\n" . $routesContent);
            $this->info('Routes from ' . $packageRoutes . ' have been appended to ' . $appRoutes);
        } else {
            $this->error('Package routes file not found: ' . $packageRoutes);
        }
    }
}