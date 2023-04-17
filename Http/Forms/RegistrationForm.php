<?php

namespace Http\Forms;

use Core\Validator;

class RegistrationForm extends Form
{
    public function validate(array $attributes = []): bool
    {
        $this->populate($attributes);

        if (!Validator::email($attributes['email'])) {
            $this->errors['email'] = 'Please provide a valid email address.';
        }
        if (!Validator::string($attributes['password'], 7, 255)) {
            $this->errors['password'] = 'Please provide a password of at least seven characters.';
        }

        return empty($this->errors);
    }
}
