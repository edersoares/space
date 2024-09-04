<?php

declare(strict_types=1);

use Dex\Laravel\Space\Database\Seeders\EntityUserSeeder;
use Dex\Laravel\Space\Models\Profile;
use Dex\Laravel\Space\Models\User;
use Dex\Pest\Plugin\Laravel\Tester\Tester;
use Illuminate\Database\Eloquent\Factories\Factory;

uses(Tester::class);

describe(User::class, function () {
    beforeEach()->eloquent(User::class);

    test()->toBeCreate();
    test()->toBeUpdate();
    test()->toBeDelete();
    test()->toHaveHasManyRelation(Profile::class, 'profiles');

    beforeEach()->wrap('data')->endpoint('/api/user');

    test()->toHaveIndexEndpoint();
    test()->toHaveShowEndpoint();
    test()->toHaveStoreEndpoint();
    test()->toHaveUpdateEndpoint();
    test()->toHaveDestroyEndpoint();

    test('do `filter` request')
        ->endpoint('/api/user?filter=name:is(Luke)+or+name:is(Leia)')
        ->factory(fn (Factory $factory) => $factory->count(3)->sequence(
            ['name' => 'Anakin'],
            ['name' => 'Leia'],
            ['name' => 'Luke'],
        ))
        ->seed(EntityUserSeeder::class)
        ->doGetRequest()
        ->assertJson([
            'data' => [
                ['name' => 'Leia'],
                ['name' => 'Luke'],
            ],
        ]);

    test('do `search` request')
        ->endpoint('/api/user?search=leia')
        ->factory(fn (Factory $factory) => $factory->count(3)->sequence(
            ['name' => 'Anakin'],
            ['name' => 'Leia'],
            ['name' => 'Luke'],
        ))
        ->seed(EntityUserSeeder::class)
        ->doGetRequest()
        ->assertJson([
            'data' => [
                ['name' => 'Leia'],
            ],
        ]);

    test('do `show` request')
        ->endpoint('/api/user?show=2')
        ->factory(fn (Factory $factory) => $factory->count(3))
        ->seed(EntityUserSeeder::class)
        ->doGetRequest()
        ->assertJsonCount(2, 'data');

    test('do `sort` request')
        ->endpoint('/api/user?sort=name:desc')
        ->factory(fn (Factory $factory) => $factory->count(3)->sequence(
            ['name' => 'Anakin'],
            ['name' => 'Leia'],
            ['name' => 'Luke'],
        ))
        ->seed(EntityUserSeeder::class)
        ->doGetRequest()
        ->assertJson([
            'data' => [
                ['name' => 'Luke'],
                ['name' => 'Leia'],
                ['name' => 'Anakin'],
            ],
        ]);
});
