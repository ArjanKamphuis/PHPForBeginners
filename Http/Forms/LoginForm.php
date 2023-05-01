<?php

namespace Http\Forms;

use Core\ValidationRule;

class LoginForm extends Form
{
    public function __construct(array $attributes)
    {
        $this->rules[] = new ValidationRule('email', 'email', 'Please provide a valid email address.');
        $this->rules[] = new ValidationRule('password', 'string', 'Please provide a valid password.');
        parent::__construct($attributes);
    }
}
