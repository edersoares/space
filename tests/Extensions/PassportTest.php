<?php

declare(strict_types=1);

use Dex\Laravel\Space\Models\Profile;
use Dex\Laravel\Space\Models\Space;
use Dex\Laravel\Space\Models\User;
use Laravel\Passport\Client;
use Laravel\Passport\Passport;

beforeEach(function () {
    Passport::setClientUuids(true);

    $this->user = User::factory()->create();
    $this->client = Client::factory()->create();

    $this->actingAs($this->user);
});

test('flow to request permission to access your account', function () {
    $this->get(route('passport.authorizations.authorize', [
        'client_id' => $this->client->id,
        'redirect_uri' => $this->client->redirect,
        'scope' => null,
        'response_type' => 'code',
        'state' => 'state',
    ]))
        ->assertOk()
        ->assertSee('is requesting permission to access your account.');

    $this->post(route('passport.authorizations.approve'), [
        'state' => 'state',
        'client_id' => $this->client->id,
        'auth_token' => session()->get('authToken'),
    ])
        ->assertRedirect()
        ->assertRedirectContains($this->client->redirect);
});

test('link client to space', function () {
    $space = Space::factory()->create([
        'client_id' => $this->client->id,
    ]);

    $this->get(route('passport.authorizations.authorize', [
        'client_id' => $this->client->id,
        'redirect_uri' => $this->client->redirect,
        'scope' => null,
        'response_type' => 'code',
        'state' => 'state',
    ]))
        ->assertOk()
        ->assertSee('is requesting permission to access your account.');

    $this->post(route('passport.authorizations.approve'), [
        'state' => 'state',
        'client_id' => $this->client->id,
        'auth_token' => session()->get('authToken'),
    ])
        ->assertRedirect()
        ->assertRedirectContains($this->client->redirect);

    $this->assertDatabaseHas(Profile::class, [
        'space_id' => $space->id,
        'user_id' => $this->user->id,
    ]);
});
