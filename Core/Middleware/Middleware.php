<?php

namespace Core\Middleware;

use Exception;

class Middleware
{
    protected const MAP = [
        'guest' => Guest::class,
        'auth' => Auth::class,
    ];

    public static function resolve(?string $key): void
    {
        if (!$key) {
            return;
        }

        if (!($middleware = static::MAP[$key] ?? false)) {
            throw new Exception("No matching middleware found for key '{$key}'.");
        }

        (new $middleware)->handle();
    }
}
