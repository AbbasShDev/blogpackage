<?php

return [
    'posts_table' => 'posts',

    'prefix' => 'blogger',

    'middleware' => ['web'],

    'notifications' => [
        'channels' => ['mail']
    ]
];