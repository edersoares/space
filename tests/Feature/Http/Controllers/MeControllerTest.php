<?php

declare(strict_types=1);

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
