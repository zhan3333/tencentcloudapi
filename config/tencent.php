<?php

return [
    'enable' => env('TENCENT_ENABLE', true),
    'secret_id' => env('TENCENT_SECRET_ID'),
    'secret_key' => env('TENCENT_SECRET_KEY'),
    'ocr' => [
        'region' => 'ap-beijing',
    ],
];
