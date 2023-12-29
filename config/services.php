<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, Postmark, AWS and more. This file provides the de facto
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
        'endpoint' => env('MAILGUN_ENDPOINT', 'api.mailgun.net'),
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'facebook' => [
        'client_id' => '1961254717590793',
        'client_secret' => 'bc5b1cac73e177a02ad4e8b93f507340',
        'redirect' => 'https://apdq.jackalit.com/auth/facebook/callback',
    ],

    'stripe' => [
        'secret' => env('STRIPE_SECRET'),

        'mode'    => env('STRIPE_MODE', 'sandbox'),
        'sandbox' => [
            'client_id'         => env('STRIPE_SANDBOX_KEY', ''),
            'client_secret'     => env('STRIPE_SANDBOX_SECRET', ''),
        ],
        'live' => [
            'client_id'         => env('STRIPE_LIVE_KEY', ''),
            'client_secret'     => env('STRIPE_LIVE_SECRET', ''),
        ],
        'currency'       => env('STRIPE_CURRENCY', 'CAD'),
    ],

];
