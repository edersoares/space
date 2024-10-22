<?php

declare(strict_types=1);

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
