<?php

namespace Dex\Laravel\Space\Http\Requests;

use Dex\Laravel\Space\Extensions\Orion\Request;

class SpaceRequest extends Request
{
    public function commonRules(): array
    {
        return [
            'name' => ['required', 'min:3', 'max:30'],
            'authorization' => ['required', 'url'],
            'url' => ['required', 'url'],
        ];
    }
}
