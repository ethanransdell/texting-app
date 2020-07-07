<?php

return [
    'default' => env('TEXT_MESSAGING_CONNECTION', 'twilio'),

    'connections' => [
        'twilio' => [
            'sid'   => env('TWILIO_SID'),
            'token' => env('TWILIO_TOKEN'),
            'from'  => env('TWILIO_FROM'),
        ],
    ],
];
