<?php

return [
    'default' => env('PAYMENTS_TYPE', 'cash'),

    'types' => [
        'cash' => [
            'driver' => 'offline',
            'authorized' => 'payment-offline',
        ],
        'card' => [
            'driver' => 'stripe',
            'authorized' => 'payment-received',
        ],
    ],
];
