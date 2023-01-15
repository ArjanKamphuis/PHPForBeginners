<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $errors = [];

    if (strlen($_POST['body']) === 0) {
        $errors['body'] = 'A body is required.';
    } else if (strlen($_POST['body']) > 1000) {
        $errors['body'] = 'The body can not be more than 1,000 characters.';
    }
    
    if (empty($errors)) {
        $config = require 'config.php';
        $db = new Database($config['database']);

        $db->query('INSERT INTO notes (body, user_id) VALUES (:body, :user_id)', [
            ':body' => $_POST['body'],
            ':user_id' => 1
        ]);
    }
}

$heading = 'Create Note';
require 'views/note-create.view.php';
