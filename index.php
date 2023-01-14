<?php

require_once 'functions.php';
require 'Database.php';
//require_once 'router.php';

$db = new Database();
$posts = $db->query('SELECT * FROM posts')->fetchAll(PDO::FETCH_ASSOC);

foreach ($posts as $post) {
    echo '<li>' . $post['title'] . '</li>';
}
