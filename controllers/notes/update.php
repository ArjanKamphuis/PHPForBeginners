<?php

use Core\App;
use Core\Database;
use Core\Validator;

$id = $_POST['id'] ?? abort();
$db = App::resolve(Database::class);

$note = $db->query('SELECT * FROM notes WHERE id = :id', [
    ':id' => $id
])->findOrFail();

$currentUserId = 1;
authorize($note['user_id'] === $currentUserId);


$errors = [];

if (!Validator::string($_POST['body'], 1, 1000)) {
    $errors['body'] = 'A body of no more than 1,000 characters is required.';
}

if (!empty($errors)) {
    return view('notes.edit', [
        'heading' => 'Edit Note',
        'errors' => $errors,
        'note' => $note
    ]);
}

$db->query('UPDATE notes SET body=:body WHERE id=:id', [
    ':body' => $_POST['body'],
    ':id' => $id
]);

redirect("/note?id={$id}");
