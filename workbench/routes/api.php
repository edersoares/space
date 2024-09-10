<?php

declare(strict_types=1);

use Orion\Facades\Orion;
use Workbench\Dex\Laravel\Space\App\Http\Controllers\DemoController;

Orion::resource('/demo', DemoController::class);
