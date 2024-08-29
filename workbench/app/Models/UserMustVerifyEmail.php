<?php

declare(strict_types=1);

namespace Workbench\Dex\Laravel\Space\App\Models;

use Dex\Laravel\Space\Models\User;
use Illuminate\Contracts\Auth\MustVerifyEmail;

class UserMustVerifyEmail extends User implements MustVerifyEmail
{
    //
}
