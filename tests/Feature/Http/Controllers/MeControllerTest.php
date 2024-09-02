<?php

declare(strict_types=1);

use Dex\Laravel\Space\Models\Profile;
use Dex\Laravel\Space\Models\User;

test('check logged user', function () {
    $user = User::factory()->create();

    $this->actingAs($user)->get('/account/me')->assertJsonFragment([
        'id' => $user->id,
        'name' => $user->name,
        'email' => $user->email,
        'profiles' => [],
    ]);
});

test('check logged user with profile', function () {
    $user = User::factory()
        ->has(Profile::factory(), 'profiles')
        ->create();

    $this->actingAs($user)->get('/account/me')->assertJson([
        'id' => $user->id,
        'name' => $user->name,
        'email' => $user->email,
        'profiles' => $user->profiles->toArray(),
    ]);
});
