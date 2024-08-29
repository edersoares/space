<?php

declare(strict_types=1);

use Dex\Laravel\Space\Models\User;
use Workbench\Dex\Laravel\Space\App\Models\UserMustVerifyEmail;

test('create new user', function () {
    $user = User::factory()->make()->toArray();

    $this->postJson('/account/register', [
        ...$user,
        'password' => 'P@ssword',
        'password_confirmation' => 'P@ssword',
    ])->assertCreated();
});

test('reset user password', function () {
    $user = User::factory()->create([
        'password' => 'P@ssword',
    ]);

    $token = app('auth.password')->broker()->createToken($user);

    $this->postJson('/account/reset-password', [
        'token' => $token,
        'email' => $user->email,
        'password' => 'P@ssword',
        'password_confirmation' => 'P@ssword',
    ])->assertOk();
});

test('update user password', function () {
    $user = User::factory()->create([
        'password' => 'P@ssword',
    ]);

    $this->actingAs($user)->putJson('/account/user/password', [
        'current_password' => 'P@ssword',
        'password' => 'NewP@ssword',
        'password_confirmation' => 'NewP@ssword',
    ])->assertOk();
});

test('update user profile information', function () {
    $user = User::factory()->create();
    $new = User::factory()->make()->toArray();

    $this->actingAs($user)->putJson('/account/user/profile-information', $new)->assertOk();
});

test('update user profile information (must verify email)', function () {
    $user = User::factory()->create();
    $new = User::factory()->make()->toArray();

    $this->actingAs(new UserMustVerifyEmail($user->getAttributes()))
        ->putJson('/account/user/profile-information', $new)
        ->assertOk();
});

test('login (test rate limiter)', function () {
    $user = User::factory()->create([
        'password' => 'P@ssword',
    ]);

    $this->postJson('/account/login', [
        'email' => $user->email,
        'password' => 'P@ssword',
    ])->assertOk();
});

test('two factor (test rate limiter)', function () {
    $this->postJson('/account/two-factor-challenge', [
        'code' => 'unknow-code',
    ])->assertJsonValidationErrors([
        'code' => 'The provided two factor authentication code was invalid.',
    ]);
});
