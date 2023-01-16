<?php

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
    $path = str_replace('.', '//', $path);
    require base_path("views/{$path}.view.php");
}

function authorize(bool $condition, $status = Response::FORBIDDEN): void
{
    if (!$condition) {
        abort($status);
    }
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
