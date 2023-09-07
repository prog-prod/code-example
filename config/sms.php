<?php

return [
    'providers' => [
        'smsClub' => [
            'token' => env('SMSCLUB_API_TOKEN', ''),
            'url' => 'https://im.smsclub.mobi/sms/send',
            'alpha_name' => 'Shop Zakaz'
        ]
    ]
];
