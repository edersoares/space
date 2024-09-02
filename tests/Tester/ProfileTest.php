<?php

declare(strict_types=1);

use Dex\Laravel\Space\Models\Profile;
use Dex\Laravel\Space\Models\Space;
use Dex\Laravel\Space\Models\User;
use Dex\Pest\Plugin\Laravel\Tester\Tester;

uses(Tester::class);

describe(Profile::class, function () {
    beforeEach()->eloquent(Profile::class);

    test()->toBeCreate();
    test()->toBeUpdate();
    test()->toBeDelete();
    test()->toHaveBelongsToRelation(Space::class, 'space');
    test()->toHaveBelongsToRelation(User::class, 'user');
});
