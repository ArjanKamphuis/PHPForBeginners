<?php

use Core\Response;

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

function login(array $user): void
{
    $_SESSION['user'] = [
        'email' => $user['email']
    ];
    session_regenerate_id(true);
}

function loggedIn(): bool
{
    return !! ($_SESSION['user'] ?? false);
}

function logout(): void
{
    $_SESSION = [];
    session_destroy();

    $params = session_get_cookie_params();
    setcookie('PHPSESSID', '', time() - 3600, $params['path'], $params['domain'], $params['secure'], $params['httponly']);
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
