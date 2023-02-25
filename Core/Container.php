<?php

namespace Core;

use Exception;

class Container
{
    protected array $bindings = [];

    public function bind(string $key, callable $callback): void
    {
        $this->bindings[$key] = $callback;
    }

    public function resolve(string $key): mixed
    {
        if (!array_key_exists($key, $this->bindings)) {
            throw new Exception("No matching binding found for {$key}");
        }

        $callback = $this->bindings[$key];
        return call_user_func($callback);
    }
}
