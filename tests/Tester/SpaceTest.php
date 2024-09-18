<?php

declare(strict_types=1);

use Dex\Laravel\Space\Models\Space;
use Dex\Laravel\Space\Models\User;
use Dex\Pest\Plugin\Laravel\Tester\Tester;
use Laravel\Passport\Passport;

uses(Tester::class);

describe(Space::class, function () {
    beforeEach()->eloquent(Space::class);

    test()->toBeCreate();
    test()->toBeUpdate();
    test()->toBeDelete();

    beforeEach()
        ->wrap('data')
        ->endpoint('/api/space');

    beforeEach(function () {
        Passport::actingAs(User::factory()->make());
    });

    test()->toHaveIndexEndpoint();
    test()->toHaveShowEndpoint();
    test()->toHaveStoreEndpoint();
    test()->toHaveUpdateEndpoint();
    test()->toHaveDestroyEndpoint();

    test()->toValidateRequired('name');
    test()->toValidateMin('name', 3);
    test()->toValidateMax('name', 30);
    test()->toValidateRequired('authorization');
    test()->toValidateRequired('url');
});
