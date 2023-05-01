<?php

namespace Http\Forms;

use Core\ValidationRule;

class RegistrationForm extends Form
{
    public function __construct(array $attributes)
    {
        $this->rules[] = new ValidationRule('email', 'email', 'Please provide a valid email address.');
        $this->rules[] = new ValidationRule('password', 'string', 'Please provide a password of at least seven characters.', ['min' => 7, 'max' => 255]);
        parent::__construct($attributes);
    }
}
