<?php

declare(strict_types=1);

namespace Dex\Laravel\Space\Http\Controllers;

use Dex\Laravel\Space\Extensions\Orion\Controller;
use Dex\Laravel\Space\Http\Requests\UserRequest;
use Dex\Laravel\Space\Models\User;
use Orion\Concerns\DisableAuthorization;

class UserController extends Controller
{
    use DisableAuthorization;

    protected $model = User::class;

    protected $request = UserRequest::class;

    public function filterableBy(): array
    {
        return [
            'id', 'name',
        ];
    }

    public function searchableBy(): array
    {
        return [
            'name',
        ];
    }

    public function sortableBy(): array
    {
        return [
            'id', 'name', 'email',
        ];
    }
}
