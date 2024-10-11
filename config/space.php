<?php

declare(strict_types=1);

return [

    'initialize' => [

        'authentication' => [
            'url' => env('SPACE_AUTHENTICATION_URL'),

            'social' => [
                'github' => env('GITHUB_CLIENT_ID') && env('GITHUB_CLIENT_SECRET'),
                'google' => env('GOOGLE_CLIENT_ID') && env('GOOGLE_CLIENT_SECRET'),
            ],
        ],

    ],

    'user' => [

        'model' => env('SPACE_USER_MODEL', Dex\Laravel\Space\Models\User::class),

    ],

    'fortify' => [

        'prefix' => env('FORTIFY_PREFIX', 'account'),

        'password-reset' => env('FORTIFY_PASSWORD_RESET', '/password/reset'),

    ],

    'socialite' => [

        'providers' => [

            'github' => [
                'client_id' => env('GITHUB_CLIENT_ID'),
                'client_secret' => env('GITHUB_CLIENT_SECRET'),
                'redirect' => env('GITHUB_REDIRECT_URL'),
            ],

            'google' => [
                'client_id' => env('GOOGLE_CLIENT_ID'),
                'client_secret' => env('GOOGLE_CLIENT_SECRET'),
                'redirect' => env('GOOGLE_REDIRECT_URL'),
            ],

        ],

    ],

];
