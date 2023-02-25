<?php

use Core\App;
use Core\Database;

$id = $_POST['id'] ?? abort();
$db = App::resolve(Database::class);

$note = $db->query('SELECT * FROM notes WHERE id = :id', [
    ':id' => $id
])->findOrFail();

$currentUserId = 1;
authorize($note['user_id'] === $currentUserId);

$db->query('DELETE from notes WHERE id = :id', [
    ':id' => $id
]);
redirect('/notes');
