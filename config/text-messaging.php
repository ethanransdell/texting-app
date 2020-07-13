<?php

return [
    'default' => env('TEXT_MESSAGING_CONNECTION', 'twilio'),

    'connections' => [
        'twilio' => [
            'sid'   => env('TWILIO_SID'),
            'token' => env('TWILIO_TOKEN'),
            'from'  => env('TWILIO_FROM'),
        ],

        'nexmo' => [
            'key'    => env('NEXMO_API_KEY'),
            'secret' => env('NEXMO_API_SECRET'),
            'from'   => env('NEXMO_FROM'),
        ],
    ],
];
