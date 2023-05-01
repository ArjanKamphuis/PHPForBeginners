<?php

namespace Core;

use Exception;

class ValidationRule
{
    protected string $name;
    protected string $method;
    protected string $error;
    protected array $params;

    public function __construct(string $name, string $method, string $error, array $params = [])
    {
        $this->name = $name;
        $this->method = $method;
        $this->error = $error;
        $this->params = $params;
    }

    public function validate(array $attributes): bool
    {
        if (!method_exists(Validator::class, $this->method)) {
            throw new Exception("Method {$this->method} does not exist on Validator.");
        }
        if (!array_key_exists($this->name, $attributes)) {
            throw new Exception("{$this->name} is not provided.");
        }
        return Validator::{$this->method}($attributes[$this->name], ... $this->params);
    }

    public function name(): string
    {
        return $this->name;
    }

    public function error(): string
    {
        return $this->error;
    }
}
