<?php

namespace Http\Forms;

use Core\Validator;

class NotesForm extends Form
{
    public function validate(string $body): bool
    {
        $this->flush();
        $this->old['body'] = $body;

        if (!Validator::string($_POST['body'], 1, 1000)) {
            $this->errors['body'] = 'A body of no more than 1,000 characters is required.';
        }

        return empty($this->errors);
    }
}
