<?php

declare(strict_types=1);

namespace Dex\Laravel\Space\Http\Controllers;

use Dex\Laravel\Space\Models\User;
use Illuminate\Http\Request;

class AuthorizationController
{
    public function __invoke(Request $request)
    {
        /** @var User $profile */
        $profile = $request->user();

        $profile->load('roles');

        return $profile->getAllPermissions()->pluck('name');
    }
}
