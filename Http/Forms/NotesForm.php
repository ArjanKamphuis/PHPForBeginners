<?php

namespace Http\Forms;

use Core\Validator;

class NotesForm extends Form
{
    public function validate(array $attributes = []): bool
    {
        $this->populate($attributes);

        if (!Validator::string($attributes['body'], 1, 1000)) {
            $this->errors['body'] = 'A body of no more than 1,000 characters is required.';
        }

        return empty($this->errors);
    }
}
