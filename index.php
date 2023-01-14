<?php

require_once 'functions.php';
//require_once 'router.php';

try {
    $dsn = 'mysql:host=localhost;port=3306;dbname=phpforbeginners;user=root;charset=utf8mb4';
    $db = new PDO($dsn);

    $statement = $db->prepare('SELECT * FROM posts');
    $statement->execute();
} catch (PDOException $e) {
    dd($e->getMessage());
}

$posts = $statement->fetchAll(PDO::FETCH_ASSOC);

foreach ($posts as $post) {
    echo '<li>' . $post['title'] . '</li>';
}
