<?php

namespace Http\Forms;

use Core\ValidationRule;

class SessionForm extends Form
{
    public function __construct()
    {
        $this->rules[] = new ValidationRule('email', 'email', 'Please provide a valid email address.');
        $this->rules[] = new ValidationRule('password', 'string', 'Please provide a valid password.');
    }
}
