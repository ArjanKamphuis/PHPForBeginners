<?php

namespace Controllers;

use Core\App;
use Core\Database;

abstract class Controller
{
    protected Database $db;
    protected array $errors = [];

    public function __construct()
    {
        $this->db = App::resolve(Database::class);
    }
}
