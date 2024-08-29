<?php

declare(strict_types=1);

return [

    'initialize' => [

        'authentication' => [
            'url' => env('SPACE_AUTHENTICATION_URL'),
        ],

    ],

    'user' => [

        'model' => env('SPACE_USER_MODEL', Dex\Laravel\Space\Models\User::class),

    ],

    'fortify' => [

        'prefix' => env('FORTIFY_PREFIX', 'account'),

        'password-reset' => env('FORTIFY_PASSWORD_RESET', '/password/reset'),

    ],

];
