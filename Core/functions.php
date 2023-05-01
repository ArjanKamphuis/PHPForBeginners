<?php

use Core\App;
use Core\Authenticator;
use Core\Response;
use Core\Session;

function dd(mixed $value): never
{
    echo '<pre>';
    var_dump($value);
    echo '</pre>';
    die();
}

function base_path(string $path): string
{
    return BASE_PATH . $path;
}

function view(string $path, array $attributes = []): void
{
    extract($attributes);
    $path = str_replace('.', DIRECTORY_SEPARATOR, $path);
    require base_path("views/{$path}.view.php");
}

function authorize(bool $condition, $status = Response::FORBIDDEN): void
{
    if (!$condition) {
        abort($status);
    }
}

function redirect(string $path): never
{
    header("Location: $path");
    exit();
}

function auth(): Authenticator
{
    return App::resolve(Authenticator::class);
}

function old(string $key, string $default = ''): string
{
    return Session::get('old')[$key] ?? $default;
}

function abort(int $code = Response::NOT_FOUND): never
{
    http_response_code($code);
    require base_path("views/{$code}.php");
    die();
}

function urlIs(string $value): bool
{
    return $_SERVER['REQUEST_URI'] === $value;
}

function addNormalNavigationStyles(string $url): string
{
    $classes = urlIs($url) ? 'bg-gray-900 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white';
    return $classes . ' px-3 py-2 rounded-md text-sm font-medium';
}

function addResponsiveNavigationStyles(string $url): string
{
    $classes = urlIs($url) ? 'bg-gray-900 text-white block' : 'text-gray-300 hover:bg-gray-700 hover:text-white';
    return $classes . ' block px-3 py-2 rounded-md text-base font-medium';
}
