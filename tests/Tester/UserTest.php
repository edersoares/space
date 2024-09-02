<?php

declare(strict_types=1);

use Dex\Laravel\Space\Models\Profile;
use Dex\Laravel\Space\Models\User;
use Dex\Pest\Plugin\Laravel\Tester\Tester;

uses(Tester::class);

describe(User::class, function () {
    beforeEach()->eloquent(User::class);

    test()->toBeCreate();
    test()->toBeUpdate();
    test()->toBeDelete();
    test()->toHaveHasManyRelation(Profile::class, 'profiles');
});
