<?php

declare(strict_types=1);

use Dex\Laravel\Space\Http\Controllers\SpaceController;
use Illuminate\Support\Facades\Route;

Route::get('space', SpaceController::class);
