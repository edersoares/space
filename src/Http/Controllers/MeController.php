<?php

declare(strict_types=1);

namespace Dex\Laravel\Space\Http\Controllers;

use Illuminate\Http\Request;

class MeController
{
    public function __invoke(Request $request): array
    {
        $user = config('space.user.model');

        $user = $user::query()
            ->with('profiles.space')
            ->findOrFail($request->user()->getKey());

        return $user->toArray();
    }
}
