<?php

function dd(mixed $value): never
{
    echo '<pre>';
    var_dump($value);
    echo '</pre>';
    die();
}

function handleException(Exception $e): never
{
    http_response_code(400);
    require 'views/exception.php';
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
