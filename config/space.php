<?php

declare(strict_types=1);

return [

    'initialize' => [

        'authentication' => [
            'url' => env('SPACE_AUTHENTICATION_URL'),

            'social' => [
                'facebook' => env('FACEBOOK_CLIENT_ID') && env('FACEBOOK_CLIENT_SECRET'),
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

            'facebook' => [
                'client_id' => env('FACEBOOK_CLIENT_ID'),
                'client_secret' => env('FACEBOOK_CLIENT_SECRET'),
                'redirect' => env('FACEBOOK_REDIRECT_URL'),
            ],

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
