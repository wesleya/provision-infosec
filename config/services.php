<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Stripe, Mailgun, SparkPost and others. This file provides a sane
    | default location for this type of information, allowing packages
    | to have a conventional place to find your various credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
    ],

    'ses' => [
        'key' => env('SES_KEY'),
        'secret' => env('SES_SECRET'),
        'region' => env('SES_REGION', 'us-east-1'),
    ],

    'sparkpost' => [
        'secret' => env('SPARKPOST_SECRET'),
    ],

    'stripe' => [
        'model' => App\User::class,
        'key' => env('STRIPE_KEY'),
        'secret' => env('STRIPE_SECRET'),
    ],

    'digitalocean' => [
        'client_id' => env('DIGITAL_OCEAN_CLIENT_ID'),         // Your GitHub Client ID
        'client_secret' => env('DIGITAL_OCEAN_CLIENT_SECRET'), // Your GitHub Client Secret
        'redirect' => env('DIGITAL_OCEAN_REDIRECT'),
    ],

    'linode' => [
        'client_id' => env('LINODE_CLIENT_ID'),
        'client_secret' => env('LINODE_CLIENT_SECRET'),
        'redirect' => env('LINODE_REDIRECT')
    ]
];
