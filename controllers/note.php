<?php

$config = require 'config.php';
$db = new Database($config['database']);

$note = $db->query('SELECT * FROM notes WHERE id = :id', [':id' => $_GET['id']])->fetch();

if (!$note) {
    abort();
}

$currentUserId = 1;
if ($note['user_id'] !== $currentUserId) {
    abort(Response::FORBIDDEN);
}

$heading = 'Note';
require 'views/note.view.php';
