<?php

declare(strict_types=1);

use Dex\Laravel\Space\Models\User;

test('check authorization', function () {
    $user = User::factory()->create();

    $this->actingAs($user)->get('/account/authorization')->assertOk();
});
