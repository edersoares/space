<?php

declare(strict_types=1);

namespace Dex\Laravel\Space\Providers;

use Illuminate\Support\Facades\Event;
use Illuminate\Support\ServiceProvider;
use SocialiteProviders\Manager\SocialiteWasCalled;
use SocialiteProviders\Microsoft\Provider;

class SocialiteServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        config([
            'services' => array_merge(
                (array) config('services'),
                (array) config('space.socialite.providers')
            ),
        ]);
    }

    public function boot(): void
    {
        Event::listen(function (SocialiteWasCalled $event) {
            $event->extendSocialite('microsoft', Provider::class);
        });
    }
}
