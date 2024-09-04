<?php

declare(strict_types=1);

use Dex\Laravel\Space\Models\Attribute;
use Dex\Laravel\Space\Models\Entity;
use Dex\Pest\Plugin\Laravel\Tester\Tester;

uses(Tester::class);

describe(Attribute::class, function () {
    beforeEach()->eloquent(Attribute::class);

    test()->toBeCreate();
    test()->toBeUpdate();
    test()->toBeDelete();
    test()->toHaveBelongsToRelation(Entity::class, 'entity');
});
