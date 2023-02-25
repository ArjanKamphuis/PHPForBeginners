<?php

use Core\App;
use Core\Container;
use Core\Database;

App::setContainer(new Container());
App::bind(Database::class, function() {
    $config = require base_path('config.php');
    return new Database($config['database']);
});
