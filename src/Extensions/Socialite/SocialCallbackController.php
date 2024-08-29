<?php

declare(strict_types=1);

namespace Dex\Laravel\Space\Extensions\Socialite;

use Dex\Laravel\Space\Models\UserSocial;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Laravel\Socialite\Contracts\User as SocialiteUser;
use Laravel\Socialite\Facades\Socialite;

class SocialCallbackController
{
    public function __invoke(string $provider): RedirectResponse
    {
        $socialite = Socialite::driver($provider)->user();

        $user = $this->findOrCreateUser($socialite);

        $this->updateOrCreateUserSocial($provider, $socialite, $user);

        $this->auth($user);

        return $this->response($user);
    }

    protected function findOrCreateUser(SocialiteUser $socialite): User
    {
        $model = $this->model();

        return $model::query()->firstOrCreate([
            'email' => $socialite->getEmail(),
        ], [
            'name' => $socialite->getName(),
            'password' => Hash::make(Str::random()),
        ]);
    }

    protected function updateOrCreateUserSocial(string $provider, SocialiteUser $socialite, User $user): UserSocial
    {
        return UserSocial::query()->updateOrCreate([
            'provider' => $provider,
            'provider_id' => $socialite->getId(),
        ], [
            'name' => $socialite->getName(),
            'email' => $socialite->getEmail(),
            'nickname' => $socialite->getNickname(),
            'avatar' => $socialite->getAvatar(),
            'user_id' => $user->getKey(),
        ]);
    }

    protected function model(): string
    {
        return config('space.user.model');
    }

    protected function auth(User $user): void
    {
        Auth::login($user);
    }

    protected function response(User $user): RedirectResponse
    {
        return redirect()->intended();
    }
}
