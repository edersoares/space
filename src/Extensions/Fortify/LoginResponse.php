<?php

namespace Dex\Laravel\Space\Extensions\Fortify;

use Laravel\Fortify\Contracts\LoginResponse as LoginResponseContract;
use Laravel\Fortify\Fortify;

class LoginResponse implements LoginResponseContract
{
    /**
     * Create an HTTP response that represents the object.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function toResponse($request)
    {
        return $request->wantsJson()
            ? response()->json([
                'two_factor' => false,
                'intended' => session()->pull('url.intended'),
            ])
            : redirect()->intended(Fortify::redirects('login'));
    }
}
