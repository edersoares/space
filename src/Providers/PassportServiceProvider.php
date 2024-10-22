<?php

declare(strict_types=1);

namespace Dex\Laravel\Space\Providers;

use Dex\Laravel\Space\Extensions\Passport\ApproveAuthorizationController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Laravel\Passport\Passport;

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

        $this->app->booted(function () {
            if (Passport::$registersRoutes) {
                Route::group([
                    'as' => 'passport.',
                    'prefix' => config('passport.path', 'oauth'),
                ], function () {
                    $guard = config('passport.guard');

                    Route::middleware(['web', $guard ? 'auth:' . $guard : 'auth'])->group(function () {
                        Route::post('/authorize', [
                            'uses' => ApproveAuthorizationController::class,
                            'as' => 'authorizations.approve',
                        ]);
                    });
                });
            }
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void {}
}
