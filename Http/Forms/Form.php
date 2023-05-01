<?php

namespace Http\Forms;

use Core\Exceptions\ValidationException;

abstract class Form
{
    protected array $errors = [];
    protected array $attributes = [];
    protected array $rules = [];

    public function __construct(array $attributes)
    {
        $this->attributes = $attributes;

        foreach ($this->rules as $rule) {
            if (!$rule->validate($attributes)) {
                $this->errors[$rule->name()] = $rule->error();
            }
        }
    }

    public static function validate(array $attributes): mixed
    {
        $instance = new static($attributes);
        return $instance->failed() ? $instance->throw() : $instance;
    }

    public function failed(): bool
    {
        return !empty($this->errors);
    }

    public function throw(): never
    {
        ValidationException::throw($this->errors(), $this->attributes);
    }

    public function error(string $field, string $message): self
    {
        $this->errors[$field] = $message;
        return $this;
    }

    public function errors(): array
    {
        return $this->errors;
    }
}
