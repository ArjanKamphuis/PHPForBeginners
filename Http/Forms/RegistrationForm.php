<?php

namespace Http\Forms;

use Core\Validator;

class RegistrationForm extends Form
{
    public function validate(string $email, string $password): bool
    {
        $this->flush();
        
        $this->old['email'] = $email;
        $this->old['password'] = $password;

        if (!Validator::email($email)) {
            $this->errors['email'] = 'Please provide a valid email address.';
        }
        if (!Validator::string($password, 7, 255)) {
            $this->errors['password'] = 'Please provide a password of at least seven characters.';
        }

        return empty($this->errors);
    }
}
