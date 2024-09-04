<?php

declare(strict_types=1);

use Dex\Laravel\Space\Models\Attribute;
use Dex\Laravel\Space\Models\Entity;
use Dex\Pest\Plugin\Laravel\Tester\Tester;

uses(Tester::class);

describe(Entity::class, function () {
    beforeEach()->eloquent(Entity::class);

    test()->toBeCreate();
    test()->toBeUpdate();
    test()->toBeDelete();
    test()->toHaveHasManyRelation(Attribute::class, 'attributes');
});
