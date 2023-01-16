<?php

namespace Core;

class Router
{
    protected array $routes = [];

    public function route(string $uri, string $method)
    {
        foreach ($this->routes as $route) {
            if ($route['uri'] === $uri && $route['method'] === strtoupper($method)) {
                return require base_path($route['controller']);
            }
        }
        abort();
    }

    public function get(string $uri, string $controller)
    {
        $this->add('GET', $uri, $controller);
    }

    public function post(string $uri, string $controller)
    {
        $this->add('POST', $uri, $controller);
    }

    public function patch(string $uri, string $controller)
    {
        $this->add('PATCH', $uri, $controller);
    }

    public function put(string $uri, string $controller)
    {
        $this->add('PUT', $uri, $controller);
    }

    public function delete(string $uri, string $controller)
    {
        $this->add('DELETE', $uri, $controller);
    }

    protected function add(string $method, string $uri, string $controller)
    {
        $this->routes[] = [
            'method' => $method,
            'uri' => $uri,
            'controller' => $controller
        ];
    }
}
