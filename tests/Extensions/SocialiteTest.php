<?php

declare(strict_types=1);

use Laravel\Socialite\Contracts\Provider;
use Laravel\Socialite\Facades\Socialite;
use Laravel\Socialite\Two\User;

test('redirect', function () {
    $this->get('/account/social/github/redirect')->assertFound();
});

test('callback', function () {
    $this->assertDatabaseCount('user', 0);
    $this->assertDatabaseCount('user_social', 0);

    $provider = mock(Provider::class);
    $user = mock(User::class);

    $user->expects('getId')->andReturn(123);
    $user->expects('getName')->zeroOrMoreTimes()->andReturn('Eder Soares');
    $user->expects('getEmail')->zeroOrMoreTimes()->andReturn('edersoares@me.com');
    $user->expects('getNickname')->andReturn('Eder');
    $user->expects('getAvatar')->andReturn(null);

    $provider->expects('user')->andReturn($user);

    Socialite::spy()->expects('driver')->andReturn($provider);

    $this->get('/account/social/github/callback?code=secret-code&state=unique-state')->assertFound();

    $this->assertDatabaseCount('user', 1);
    $this->assertDatabaseCount('user_social', 1);
});
