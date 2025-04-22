<?php 

use Illuminate\Support\Str;

return [

    'driver' => env('SESSION_DRIVER', 'database'),

    'lifetime' => env('SESSION_LIFETIME', 120),

    'expire_on_close' => env('SESSION_EXPIRE_ON_CLOSE', false),

    'encrypt' => env('SESSION_ENCRYPT', true), // Encrypt session data for security

    'files' => storage_path('framework/sessions'),

    'connection' => env('SESSION_CONNECTION', 'mongodb'), // Ensure it points to MongoDB

    'table' => env('SESSION_TABLE', 'sessions'),

    'store' => env('SESSION_STORE'),

    'lottery' => [2, 100],

    'cookie' => env(
        'SESSION_COOKIE',
        Str::slug(env('APP_NAME', 'laravel'), '_').'_session'
    ),

    'path' => '/',

    'domain' => env('SESSION_DOMAIN', null), // Keep null if using Laravel as API

    'secure' => env('SESSION_SECURE_COOKIE', true), // Force HTTPS for security

    'http_only' => true, // Prevent JavaScript from accessing cookies

    'same_site' => env('SESSION_SAME_SITE', 'none'), // Needed for cross-site requests

    'partitioned' => env('SESSION_PARTITIONED_COOKIE', true), // Improve cross-site security

];
