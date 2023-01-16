<?php

use Core\Database;
use Core\Validator;

$errors = [];

if (!Validator::string($_POST['body'], 1, 1000)) {
    $errors['body'] = 'A body of no more than 1,000 characters is required.';
}

if (!empty($errors)) {
    return view('notes.create', [
        'heading' => 'Create Note',
        'errors' => $errors
    ]);
}

$config = require base_path('config.php');
$db = new Database($config['database']);

$db->query('INSERT INTO notes (body, user_id) VALUES (:body, :user_id)', [
    ':body' => $_POST['body'],
    ':user_id' => 1
]);
redirect("/note?id={$db->getLastInsertedId()}");
