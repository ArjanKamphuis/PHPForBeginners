<?php

use Core\Database;

$config = require base_path('config.php');
$db = new Database($config['database']);

$currentUserId = 1;
$notes = $db->query('SELECT * FROM notes WHERE user_id = :user_id', [
    ':user_id' => $currentUserId
])->get();

view('notes.index', [
    'heading' => 'My Notes',
    'notes' => $notes
]);
