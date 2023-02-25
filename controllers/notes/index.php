<?php

use Core\App;
use Core\Database;

$currentUserId = 1;
$db = App::resolve(Database::class);

$notes = $db->query('SELECT * FROM notes WHERE user_id = :user_id', [
    ':user_id' => $currentUserId
])->get();

view('notes.index', [
    'heading' => 'My Notes',
    'notes' => $notes
]);
