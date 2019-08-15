<?php
return [
    'single' => [
        'driver' => 'single',
        'tap' => [App\Logging\CustomizeFormatter::class],
        'path' => storage_path('logs/debug-logs/debug.log'),
        'level' => 'debug',
    ],
];