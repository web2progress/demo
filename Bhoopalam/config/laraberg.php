<?php

use VanOns\Laraberg\Models\Block;
use VanOns\Laraberg\Models\Content;

return [
    /*
    |--------------------------------------------------------------------------
    | API Routes
    |--------------------------------------------------------------------------
    */

    'use_package_routes' => true,

    'middlewares' => ['web', 'auth'],

    'prefix' => 'laraberg',

    "models" => [
        "block" => Block::class,
        "content" => Content::class,
    ],
    /*
    |--------------------------------------------------------------------------
    | Embed settings
    |--------------------------------------------------------------------------
    */
    'embed' => [
        'maxwidth' => 1200,
        'maxheight' => 1200,

        'cache' => [
            'enabled' => true,
            'duration' => 86400
        ]
    ]
];
