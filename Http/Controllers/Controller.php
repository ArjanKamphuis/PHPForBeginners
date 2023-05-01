<?php

namespace Http\Controllers;

use Core\App;
use Core\Database;

abstract class Controller
{
    protected Database $db;

    public function __construct()
    {
        $this->db = App::resolve(Database::class);
    }
}
