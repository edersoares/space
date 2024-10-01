<?php

declare(strict_types=1);

namespace Dex\Laravel\Space\Http\Controllers;

use Dex\Laravel\Space\Models\Profile;
use Illuminate\Http\Request;

class SetDefaultProfileController
{
    public function __invoke(Request $request): array
    {
        $default = $request->input('default');

        $profile = Profile::query()
            ->where('user_id', $request->user()->getKey())
            ->where('id', $default)
            ->firstOrFail();

        Profile::query()
            ->where('user_id', $request->user()->getKey())
            ->whereNot('id', $default)
            ->update(['is_default' => false]);

        $profile->update(['is_default' => true]);

        return [
            'data' => $profile->toArray(),
        ];
    }
}
