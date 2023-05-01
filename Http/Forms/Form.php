<?php

namespace Http\Forms;

use Core\Session;

abstract class Form
{
    protected array $errors = [];
    protected array $attributes = [];
    protected array $rules = [];

    public static function resolve()
    {
        return Session::has('form') ? unserialize(Session::get('form')) : new (static::class);
    }

    public function validate(array $attributes = []): bool
    {
        $this->populate($attributes);

        foreach ($this->rules as $rule) {
            if (!$rule->validate($attributes)) {
                $this->errors[$rule->name()] = $rule->error();
            }
        }

        return empty($this->errors);
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
        return $this->attributes[$key] ?? $default;
    }

    protected function populate(array $attributes = []): void
    {
        $this->errors = [];
        $this->attributes = $attributes;
    }
}
