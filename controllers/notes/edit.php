<?php

use Core\App;
use Core\Database;

$id = $_GET['id'] ?? abort();
$db = App::resolve(Database::class);

$note = $db->query('SELECT * FROM notes WHERE id = :id', [
    ':id' => $id
])->findOrFail();

$currentUserId = 1;
authorize($note['user_id'] === $currentUserId);

view('notes.edit', [
    'heading' => 'Edit Note',
    'errors' => [],
    'note' => $note
]);
