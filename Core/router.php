<?php

use Core\Response;

function routeToController(string $uri, array $routes): void
{
    if (array_key_exists($uri, $routes)) {
        require base_path($routes[$uri]);
    } else {
        abort();
    }
}

function abort(int $code = Response::NOT_FOUND): never
{
    http_response_code($code);
    require base_path("views/{$code}.php");
    die();
}

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$routes = require base_path('routes.php');
routeToController($uri, $routes);
