<?php

function routeToController(string $uri, array $routes): void
{
    if (array_key_exists($uri, $routes)) {
        require $routes[$uri];
    } else {
        abort();
    }
}

function abort(int $code = Response::NOT_FOUND): never
{
    http_response_code($code);
    require "views/{$code}.php";
    die();
}

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$routes = require 'routes.php';
routeToController($uri, $routes);
