<?php

declare(strict_types=1);

use Dex\Laravel\Space\Database\Seeders\EntityUserSeeder;
use Dex\Laravel\Space\Models\Profile;
use Dex\Laravel\Space\Models\User;
use Dex\Pest\Plugin\Laravel\Tester\Tester;
use Illuminate\Database\Eloquent\Factories\Factory;
use Laravel\Passport\Passport;

uses(Tester::class);

describe(User::class, function () {
    beforeEach()->eloquent(User::class);

    test()->toBeCreate();
    test()->toBeUpdate();
    test()->toBeDelete();
    test()->toHaveHasManyRelation(Profile::class, 'profiles');

    beforeEach()
        ->seed(EntityUserSeeder::class)
        ->wrap('data')
        ->endpoint('/api/user')
        ->transformPayload(fn ($payload) => collect($payload)->put('password', 'password')->put('password_confirmation', 'password')->all());

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
    test()->toValidateMax('name', 100);
    test()->toValidateRequired('email');
    test()->toValidateRequired('password');
    test()->toValidateMin('password', 8);
    test()->toValidateMax('password', 128);

    test('do `filter` request')
        ->endpoint('/api/user?filter=name:is(Luke)+or+name:is(Leia)')
        ->factory(fn (Factory $factory) => $factory->count(3)->sequence(
            ['name' => 'Anakin'],
            ['name' => 'Leia'],
            ['name' => 'Luke'],
        ))
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
        ->doGetRequest()
        ->assertJson([
            'data' => [
                ['name' => 'Leia'],
            ],
        ]);

    test('do `show` request')
        ->endpoint('/api/user?show=2')
        ->factory(fn (Factory $factory) => $factory->count(3))
        ->doGetRequest()
        ->assertJsonCount(2, 'data');

    test('do `sort` request')
        ->endpoint('/api/user?sort=name:desc')
        ->factory(fn (Factory $factory) => $factory->count(3)->sequence(
            ['name' => 'Anakin'],
            ['name' => 'Leia'],
            ['name' => 'Luke'],
        ))
        ->doGetRequest()
        ->assertJson([
            'data' => [
                ['name' => 'Luke'],
                ['name' => 'Leia'],
                ['name' => 'Anakin'],
            ],
        ]);
});
