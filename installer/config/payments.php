<?php

return [
    'default' => env('PAYMENTS_TYPE', 'cash'),

    'types' => [
        'cash' => [
            'driver' => 'offline',
            'released' => 'payment-offline',
        ],
        'card' => [
            'driver' => 'stripe',
            'released' => 'payment-received',
        ],
    ],
];
