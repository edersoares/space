<?php

declare(strict_types=1);

namespace Dex\Laravel\Space\Providers;

use Dex\Laravel\Space\Extensions\Fortify\CreateNewUser;
use Dex\Laravel\Space\Extensions\Fortify\ResetUserPassword;
use Dex\Laravel\Space\Extensions\Fortify\UpdateUserPassword;
use Dex\Laravel\Space\Extensions\Fortify\UpdateUserProfileInformation;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
use Laravel\Fortify\Features;
use Laravel\Fortify\Fortify;

class FortifyServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        config([
            'fortify.prefix' => config('space.fortify.prefix'),
            'fortify.views' => false,
            'fortify.features' => [
                Features::registration(),
                Features::resetPasswords(),
                Features::emailVerification(),
                Features::updateProfileInformation(),
                Features::updatePasswords(),
                Features::twoFactorAuthentication([
                    'confirm' => true,
                    'confirmPassword' => true,
                    // 'window' => 0,
                ]),
            ],
            'fortify.limiters' => [
                'login' => 'login',
                'two-factor' => 'two-factor',
            ],
            'cors.paths' => array_merge((array) config('cors.paths'), [
                config('space.fortify.prefix') . '/*',
            ]),
            'cors.supports_credentials' => true,
            'auth.passwords.users.table' => 'user_password_reset_token',
            'auth.providers.users.model' => config('space.user.model'),
        ]);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Fortify::createUsersUsing(CreateNewUser::class);
        Fortify::updateUserProfileInformationUsing(UpdateUserProfileInformation::class);
        Fortify::updateUserPasswordsUsing(UpdateUserPassword::class);
        Fortify::resetUserPasswordsUsing(ResetUserPassword::class);

        RateLimiter::for('login', function (Request $request) {
            $throttleKey = Str::transliterate(Str::lower($request->string(Fortify::username())->value()) . '|' . $request->ip());

            return Limit::perMinute(5)->by($throttleKey);
        });

        RateLimiter::for('two-factor', function (Request $request) {
            return Limit::perMinute(5)->by($request->session()->get('login.id'));
        });

        ResetPassword::createUrlUsing(fn ($user, $token) => config('space.fortify.password-reset') . "?token=$token&email={$user->getEmailForPasswordReset()}");
    }
}
