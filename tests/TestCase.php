<?php

declare(strict_types=1);

namespace Dex\Laravel\Space\Tests;

use Dex\Laravel\Space\Providers\SpaceServiceProvider;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Str;
use Laravel\Fortify\FortifyServiceProvider;
use Laravel\Socialite\SocialiteServiceProvider;
use Orchestra\Testbench\TestCase as Orchestra;
use Orion\OrionServiceProvider;
use Workbench\Dex\Laravel\Space\App\Providers\WorkbenchServiceProvider;

class TestCase extends Orchestra
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        Factory::guessFactoryNamesUsing(
            fn (string $modelName) => 'Dex\\Laravel\\Space\\Database\\Factories\\' . class_basename($modelName) . 'Factory'
        );

        Factory::guessModelNamesUsing(
            fn ($factory) => 'Dex\\Laravel\\Space\\Models\\' . Str::replaceLast('Factory', '', class_basename($factory))
        );
    }

    protected function getPackageProviders($app): array
    {
        return [
            FortifyServiceProvider::class,
            OrionServiceProvider::class,
            SocialiteServiceProvider::class,
            SpaceServiceProvider::class,
            WorkbenchServiceProvider::class,
        ];
    }
}
