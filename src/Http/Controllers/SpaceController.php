<?php

declare(strict_types=1);

namespace Dex\Laravel\Space\Http\Controllers;

use Dex\Laravel\Space\Extensions\Orion\Controller;
use Dex\Laravel\Space\Http\Requests\SpaceRequest;
use Dex\Laravel\Space\Models\Space;
use Orion\Concerns\DisableAuthorization;

class SpaceController extends Controller
{
    use DisableAuthorization;

    protected $model = Space::class;

    protected $request = SpaceRequest::class;

    public function searchableBy(): array
    {
        return [
            'name',
        ];
    }

    public function sortableBy(): array
    {
        return [
            'id', 'name', 'url',
        ];
    }
}
