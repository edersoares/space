<?php

declare(strict_types=1);

use Dex\Laravel\Space\Extensions\Socialite\SocialCallbackController;
use Dex\Laravel\Space\Extensions\Socialite\SocialRedirectController;
use Dex\Laravel\Space\Http\Controllers\AuthorizationController;
use Dex\Laravel\Space\Http\Controllers\MeController;
use Dex\Laravel\Space\Http\Controllers\SetDefaultProfileController;
use Dex\Laravel\Space\Http\Middleware\AcceptJson;
use Illuminate\Support\Facades\Route;

Route::group([
    'middleware' => config('fortify.middleware'),
    'prefix' => config('fortify.prefix'),
], function () {
    Route::group([
        'middleware' => AcceptJson::class,
    ], function () {
        // Initialize
        Route::get('initialize', function () {
            return config('space.initialize');
        });

        // CSRF endpoint (Sanctum style)
        Route::get('csrf', function () {
            return response()->noContent();
        });

        // User info endpoint (API style)
        Route::middleware([
            config('fortify.auth_middleware') . ':' . config('fortify.guard'),
        ])->get('me', MeController::class)->name('me');

        Route::middleware([
            config('fortify.auth_middleware') . ':' . config('fortify.guard'),
        ])->put('user/set-default-profile', SetDefaultProfileController::class);

        Route::middleware([
            config('fortify.auth_middleware') . ':' . config('fortify.guard'),
        ])->get('authorization', AuthorizationController::class)->name('authorization');
    });

    Route::get('social/{provider}/redirect', SocialRedirectController::class)->name('social.redirect');
    Route::get('social/{provider}/callback', SocialCallbackController::class)->name('social.callback');
});
