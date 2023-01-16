<?php

use Core\Database;

$config = require base_path('config.php');
$db = new Database($config['database']);

$id = $_GET['id'] ?? abort();
$note = $db->query('SELECT * FROM notes WHERE id = :id', [
    ':id' => $id
])->findOrFail();

$currentUserId = 1;
authorize($note['user_id'] === $currentUserId);

view('notes.show', [
    'heading' => 'Note',
    'note' => $note
]);
