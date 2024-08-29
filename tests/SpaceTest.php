<?php

declare(strict_types=1);

use Dex\Laravel\Space\Models\Space;

test('command exists', function () {
    $this->artisan('space')
        ->expectsOutput('Space for new ideas')
        ->assertSuccessful();
});

test('route exists', function () {
    $this->get('space')
        ->assertSee('Space for new ideas')
        ->assertOk();
});

test('database table is empty', function () {
    $this->assertDatabaseEmpty(Space::class);
});
