<?php
return [
    'secret' => env('JWT_SECRET'),
    'ttl' => env('JWT_TTL', 60),
    'refresh_ttl' => env('JWT_REFRESH_TTL', 20160),
    'algo' => env('JWT_ALGO', 'HS256'),
    'required_claims' => [
        'iss',
        'iat',
        'exp',
        'nbf',
        'sub',
        'jti',
    ],
    'blacklist_enabled' => env('JWT_BLACKLIST_ENABLED', true),
    'blacklist_grace_period' => env('JWT_BLACKLIST_GRACE_PERIOD', 0),
    'providers' => [
        'user' => 'Tymon\JWTAuth\Providers\User\EloquentUserAdapter',
        'jwt' => 'Tymon\JWTAuth\Providers\JWT\Lcobucci',
        'auth' => 'Tymon\JWTAuth\Providers\Auth\Illuminate',
        'storage' => 'Tymon\JWTAuth\Providers\Storage\Illuminate',
    ],
];
