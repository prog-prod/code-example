<?php

return [
    'exchange_rates' => [
        'UAH' => [
            'success' => true,
            'timestamp' => time(),
            'base' => 'UAH',
            'date' => date('Y-m-d'),
            'rates' => [
                'USD' => 0.026955
            ]
        ],
        'USD' => [
            'success' => true,
            'timestamp' => time(),
            'base' => 'USD',
            'date' => date('Y-m-d'),
            'rates' => [
                'UAH' => 37.099184
            ]
        ]
    ],
    'api_key' => env('API_LAYER_API_KEY', '')
];
