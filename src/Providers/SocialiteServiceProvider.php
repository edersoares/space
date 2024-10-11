<?php

declare(strict_types=1);

namespace Dex\Laravel\Space\Providers;

use Illuminate\Support\ServiceProvider;

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
}
