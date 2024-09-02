<?php

declare(strict_types=1);

use Dex\Laravel\Space\Models\Space;
use Dex\Pest\Plugin\Laravel\Tester\Tester;

uses(Tester::class);

describe(Space::class, function () {
    beforeEach()->eloquent(Space::class);

    test()->toBeCreate();
    test()->toBeUpdate();
    test()->toBeDelete();
});
