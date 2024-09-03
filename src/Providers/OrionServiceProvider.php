<?php

declare(strict_types=1);

namespace Dex\Laravel\Space\Providers;

use Dex\Laravel\Space\Extensions\Orion\QueryBuilder;
use Illuminate\Support\ServiceProvider;
use Orion\Contracts\QueryBuilder as OrionQueryBuilder;

class OrionServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->booted(function () {
            $this->app->bind(OrionQueryBuilder::class, QueryBuilder::class);
        });
    }
}
