<?php

namespace Http\Forms;

use Core\Validator;

class LoginForm extends Form
{
    public function validate(string $email, string $password): bool
    {
        $this->errors = [];
        $this->old = [];
        
        $this->old['email'] = $email;
        $this->old['password'] = $password;

        if (!Validator::email($email)) {
            $this->errors['email'] = 'Please provide a valid email address.';
        }
        if (!Validator::string($password)) {
            $this->errors['password'] = 'Please provide a valid password.';
        }

        return empty($this->errors);
    }
}
