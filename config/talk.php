<?php

return [
    'user' => [
        'model' => 'App\User',
    ],
    'broadcast' => [
        'enable' => false,
        'app_name' => 'ALOE',
        'pusher' => [
            'app_id' => '',
            'app_key' => '',
            'app_secret' => '',
            'options' => [
                'cluster' => 'ap1',
                'encrypted' => true
            ]
        ],
    ],
];