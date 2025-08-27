<?php

declare(strict_types=1);

namespace Dex\Laravel\Space\Providers;

use Dex\Laravel\Space\Console\Commands\SpaceCommand;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
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

            $this->schema();
        }
    }

    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__ . '/../../config/space.php', 'space');

        $this->app->register(FortifyServiceProvider::class);
        $this->app->register(OrionServiceProvider::class);
        $this->app->register(PassportServiceProvider::class);
        $this->app->register(PermissionServiceProvider::class);
        $this->app->register(SocialiteServiceProvider::class);
    }

    private function schema(): void
    {
        Schema::macro('isPostgres', function () {
            return Schema::getConnection()->getDriverName() !== 'pgsql';
        });

        Schema::macro('createIndexUsingGin', function (string $table, string $column) {
            if (Schema::isPostgres() === false) {
                return;
            }

            $index = "{$table}_{$column}_gin_index";

            DB::statement("CREATE INDEX $index ON \"$table\" USING gin ($column gin_trgm_ops);");
        });

        Schema::macro('dropIndexUsingGin', function (string $table, string $column) {
            if (Schema::isPostgres() === false) {
                return;
            }

            $index = "{$table}_{$column}_gin_index";

            DB::statement("DROP INDEX IF EXISTS $index;");
        });

        Schema::macro('createExtension', function (string $extension) {
            if (Schema::isPostgres() === false) {
                return;
            }

            DB::statement("CREATE EXTENSION IF NOT EXISTS $extension;");
        });

        Schema::macro('dropExtension', function (string $extension) {
            if (Schema::isPostgres() === false) {
                return;
            }

            DB::statement("DROP EXTENSION IF EXISTS $extension;");
        });
    }
}
