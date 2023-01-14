<?php

require 'functions.php';
require 'Database.php';
//require_once 'router.php';

$config = require 'config.php';
$db = new Database($config['database']);
$posts = $db->query('SELECT * FROM posts')->fetchAll();

dd($posts);
