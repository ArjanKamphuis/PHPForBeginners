<?php

namespace Http\Forms;

use Core\Validator;

class SessionForm extends Form
{
    public function validate(array $attributes = []): bool
    {
        $this->populate($attributes);

        if (!Validator::email($attributes['email'])) {
            $this->errors['email'] = 'Please provide a valid email address.';
        }
        if (!Validator::string($attributes['password'])) {
            $this->errors['password'] = 'Please provide a valid password.';
        }

        return empty($this->errors);
    }
}
