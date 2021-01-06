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
        'region' => 'us-east-1',
    ],

    'sparkpost' => [
        'secret' => env('SPARKPOST_SECRET'),
    ],

    'stripe' => [
        'model' => App\User::class,
        'key' => env('STRIPE_KEY'),
        'secret' => env('STRIPE_SECRET'),
    ],

    'facebook' => [
        'client_id' => '146842422700210',
        'client_secret' => '809fe8ff62cb08aad8bfaf90e4e7bde8',
        'redirect' => 'http://localhost:8000/customer/facebook/callback',
    ],

    'google' => [
        'client_id' => '258755851892-f5fru1d77dvsdcqckandeeu441aoaqhk.apps.googleusercontent.com',
        'client_secret' => 'Bvx3RO9F0l5ZVZa1f5s7Q07e',
        'redirect' => 'http://127.0.0.1:8000/customer/google/callback',
    ],
];
