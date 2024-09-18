<?php

declare(strict_types=1);

namespace Dex\Laravel\Space\Providers;

use Illuminate\Support\ServiceProvider;

class PassportServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        config([
            'auth.guards.api' => [
                'driver' => 'passport',
                'provider' => 'users',
            ],
            'passport.client_uuids' => true,
            'passport.path' => 'account/oauth',
        ]);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
    }
}
