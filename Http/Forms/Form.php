<?php

namespace Http\Forms;

use Core\Session;
use ReflectionClass;

abstract class Form
{
    protected array $errors = [];
    protected array $old = [];

    public static function resolve()
    {
        return Session::has('form') ? unserialize(Session::get('form')) : new (static::class);
    }

    public function flash()
    {
        Session::flash('form', serialize($this));
    }

    public function hasError(string $key): bool
    {
        return !! $this->error($key);
    }

    public function errors(): array
    {
        return $this->errors;
    }

    public function error(string $key, string $default = '')
    {
        return $this->errors[$key] ?? $default;
    }

    public function setError(string $field, string $message): void
    {
        $this->errors[$field] = $message;
    }

    public function old(string $key, mixed $default = null): mixed
    {
        return $this->old[$key] ?? $default;
    }

    public function flush(): void
    {
        $this->errors = [];
        $this->old = [];
    }
}
