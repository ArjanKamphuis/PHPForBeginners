<?php

$config = require 'config.php';
$db = new Database($config['database']);

$note = $db->query('SELECT * FROM notes WHERE id = :id', [':id' => $_GET['id']])->fetch();

$heading = 'Note';
require 'views/note.view.php';
