<?php

return [
    'default' => env('PAYMENTS_TYPE', 'cash'),

    'types' => [
        'cash-in-hand' => [
            'driver' => 'offline',
            'authorized' => 'payment-offline',
        ],
    ],
];
