<?php

$config = require 'config.php';
$db = new Database($config['database']);

$currentUserId = 1;
$notes = $db->query('SELECT * FROM notes WHERE user_id = :user_id', [
    ':user_id' => $currentUserId
])->get();

$heading = 'My Notes';
require 'views/notes/index.view.php';
