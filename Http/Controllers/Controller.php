<?php

namespace Http\Controllers;

use Core\App;
use Core\Database;
use Http\Forms\Form;
use ReflectionClass;

abstract class Controller
{
    protected Database $db;
    protected Form $form;

    public function __construct()
    {
        $this->db = App::resolve(Database::class);
        $name = substr((new ReflectionClass($this))->getShortName(), 0, -10);
        $this->form = ("Http\\Forms\\{$name}Form")::resolve();
    }

    protected function failForm(string $redirect = '/')
    {
        $this->form->flash();
        return redirect($redirect);
    }
}
