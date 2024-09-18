<?php

declare(strict_types=1);

use Dex\Laravel\Space\Http\Controllers\SpaceController;
use Dex\Laravel\Space\Http\Controllers\UserController;
use Dex\Laravel\Space\Http\Middleware\AcceptJson;
use Illuminate\Support\Facades\Route;
use Orion\Facades\Orion;


Route::group(['prefix' => 'api', 'middleware' => [AcceptJson::class, 'auth:api']], function () {
    Orion::resource('space', SpaceController::class);
    Orion::resource('user', UserController::class);
});
