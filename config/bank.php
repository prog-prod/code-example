<?php

return [
    'mono' => [
        'apiKey' => env('API_MONO', ''),
        'webhook_url' => env('MONO_WEBHOOK_URL', ''),
        'webhook_domain' => env('MONO_WEBHOOK_DOMAIN', env('APP_URL'))
    ]
];
