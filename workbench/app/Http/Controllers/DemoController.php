<?php

namespace Workbench\Dex\Laravel\Space\App\Http\Controllers;

use Dex\Laravel\Space\Extensions\Orion\Controller;
use Dex\Laravel\Space\Models\User;
use Orion\Concerns\DisableAuthorization;
use Workbench\Dex\Laravel\Space\App\Models\Demo;

class DemoController extends Controller
{
    use DisableAuthorization;

    protected $model = Demo::class;

    public function resolveUser(): User
    {
        return new User([
            'id' => 1,
            'name' => 'Guest',
        ]);
    }
}
