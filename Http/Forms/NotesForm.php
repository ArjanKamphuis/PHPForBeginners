<?php

namespace Http\Forms;

use Core\ValidationRule;

class NotesForm extends Form
{
    public function __construct()
    {
        $this->rules[] = new ValidationRule('body', 'string', 'A body of no more than 1,000 characters is required.', [1, 1000]);
    }
}
