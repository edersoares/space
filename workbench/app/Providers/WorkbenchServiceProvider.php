<?php

declare(strict_types=1);

namespace Workbench\Dex\Laravel\Space\App\Providers;

use Illuminate\Support\ServiceProvider;
use Orion\Facades\Orion;
use Workbench\Dex\Laravel\Space\App\Http\Controllers\DemoController;

class WorkbenchServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $this->loadMigrationsFrom(__DIR__ . '/../../database/migrations');

        Orion::resource('/api/demo', DemoController::class);
    }
}
