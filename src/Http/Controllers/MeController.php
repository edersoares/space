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
            ->findOrFail($request->user()->getKey());

        return array_merge($user->toArray(), [
            'profiles' => [],
        ]);
    }
}
