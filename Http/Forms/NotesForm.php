<?php

namespace Http\Forms;

use Core\ValidationRule;

class NotesForm extends Form
{
    public function __construct(array $attributes)
    {
        $this->rules[] = new ValidationRule('body', 'string', 'A body of no more than 1,000 characters is required.', ['min' => 1, 'max' => 1000]);
        parent::__construct($attributes);
    }
}
