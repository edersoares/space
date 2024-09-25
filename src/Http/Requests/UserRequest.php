<?php

declare(strict_types=1);

namespace Dex\Laravel\Space\Http\Requests;

use Dex\Laravel\Space\Extensions\Orion\Request;

class UserRequest extends Request
{
    public function storeRules(): array
    {
        return [
            'name' => ['required', 'min:3', 'max:100'],
            'email' => ['required', 'email', 'unique:user'],
            'password' => ['required', 'min:8', 'max:128'],
        ];
    }

    public function updateRules(): array
    {
        $id = $this->route()->parameter('user');

        return [
            'name' => ['required', 'min:3', 'max:100'],
            'email' => ['required', 'email', "unique:user,email,$id,id"],
        ];
    }
}
