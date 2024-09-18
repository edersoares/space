<?php

declare(strict_types=1);

namespace Dex\Laravel\Space\Extensions\Socialite;

use Illuminate\Http\RedirectResponse;
use Laravel\Socialite\Facades\Socialite;

class SocialRedirectController
{
    public function __invoke(string $provider): RedirectResponse
    {
        session()->put('url.intended', request('intended'));

        return Socialite::driver($provider)->redirect();
    }
}
