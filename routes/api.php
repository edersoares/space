<?php

declare(strict_types=1);

use Dex\Laravel\Space\Http\Controllers\UserController;
use Orion\Facades\Orion;

Orion::resource('/api/user', UserController::class);
