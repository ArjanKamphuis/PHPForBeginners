<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    dd($_POST);
}

$heading = 'Create Note';
require 'views/note-create.view.php';
