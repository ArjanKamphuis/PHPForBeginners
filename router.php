<?php

$routes = [
    '/' => 'controllers/index.php',
    '/about' => 'controllers/about.php',
    '/contact' => 'controllers/contact.php'
];

function routeToController(string $uri, array $routes): mixed
{
    if (array_key_exists($uri, $routes)) {
        require $routes[$uri];
    } else {
        abort();
    }
}

function abort(int $code = 404): never
{
    http_response_code($code);
    require "views/{$code}.php";
    die();
}

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
routeToController($uri, $routes);
