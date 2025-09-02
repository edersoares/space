<?php

declare(strict_types=1);

namespace Dex\Laravel\Space\Extensions\Socialite;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;

class SocialRedirectController
{
    public function __invoke(Request $request, string $provider): RedirectResponse
    {
        if ($request->has('intended')) {
            $request->session()->put('url.intended', $request->get('intended'));
        }

        return Socialite::driver($provider)->redirect();
    }
}
