<?php

use Core\Exceptions\ValidationException;
use Core\Router;
use Core\Session;

session_start();

const BASE_PATH = __DIR__ . '/../';
require BASE_PATH . 'Core/functions.php';

spl_autoload_register(function($class) {
    $class = str_replace('\\', DIRECTORY_SEPARATOR, $class);
    require base_path("{$class}.php");
});

require base_path('bootstrap.php');

$router = new Router();
$routes = require base_path('routes.php');

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$method = $_POST['_method'] ?? $_SERVER['REQUEST_METHOD'];

try {
    $router->route($uri, $method);
} catch (ValidationException $ex) {
    Session::flash('errors', $ex->errors);
    Session::flash('old', $ex->old);
    redirect($router->previousUrl());
}

Session::unflash();
