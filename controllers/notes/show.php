<?php

use Core\Database;

$config = require base_path('config.php');
$db = new Database($config['database']);

$id = $_POST['id'] ?? $_GET['id'] ?? abort();
$note = $db->query('SELECT * FROM notes WHERE id = :id', [
    ':id' => $id
])->findOrFail();

$currentUserId = 1;
authorize($note['user_id'] === $currentUserId);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $db->query('DELETE from notes WHERE id = :id', [
        ':id' => $id
    ]);
    header('Location: /notes');
    exit();
}

view('notes.show', [
    'heading' => 'Note',
    'note' => $note
]);
