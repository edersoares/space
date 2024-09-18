<?php

declare(strict_types=1);

namespace Dex\Laravel\Space\Providers;

use Dex\Laravel\Space\Console\Commands\SpaceCommand;
use Illuminate\Support\ServiceProvider;

class SpaceServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->loadRoutesFrom(__DIR__ . '/../../routes/space.php');
        $this->loadRoutesFrom(__DIR__ . '/../../routes/api.php');
        $this->loadViewsFrom(__DIR__ . '/../../resources/views', 'space');

        if ($this->app->runningInConsole()) {
            $this->commands([
                SpaceCommand::class,
            ]);

            $this->loadMigrationsFrom([
                __DIR__ . '/../../database/migrations',
            ]);
        }
    }

    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__ . '/../../config/space.php', 'space');

        $this->app->register(FortifyServiceProvider::class);
        $this->app->register(OrionServiceProvider::class);
        $this->app->register(PassportServiceProvider::class);
        $this->app->register(SocialiteServiceProvider::class);
    }
}
