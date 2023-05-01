<?php

namespace Core;

use Core\Middleware\Auth;
use Core\Middleware\Guest;
use Core\Middleware\Middleware;

class Router
{
    protected array $routes = [];
    protected array $methods = ['get', 'post', 'patch', 'put', 'delete'];

    public function __call(string $name, array $arguments): mixed
    {
        if (!in_array($name, $this->methods) || count($arguments) !== 2) {
            abort(Response::BAD_REQUEST);
        }

        $method = strtoupper($name);
        $uri = $arguments[0];
        $action = $arguments[1];

        if (is_callable($action)) {
            $this->routes[] = [
                'method' => $method,
                'uri' => $uri,
                'middleware' => null,
                'callable' => $action,
            ];
        } else if (is_array($action) && count($action) == 2) {
            $this->routes[] = [
                'method' => $method,
                'uri' => $uri,
                'middleware' => null,
                'controller' => [
                    'name' => $action[0],
                    'function' => $action[1]
                ]
            ];
        } else {
            abort(Response::BAD_REQUEST);
        }

        return $this;
    }

    public function route(string $uri, string $method): mixed
    {
        foreach ($this->routes as $route) {
            if ($route['uri'] === $uri && $route['method'] === strtoupper($method)) {
                Middleware::resolve($route['middleware']);
                
                if (array_key_exists('callable', $route)) {
                    return call_user_func($route['callable']);
                }
                if (array_key_exists('controller', $route)) {
                    return (new $route['controller']['name'])->{$route['controller']['function']}();
                }
            }
        }
        abort();
    }

    public function only(string $key): self
    {
        $this->routes[array_key_last($this->routes)]['middleware'] = $key;
        return $this;
    }

    public function previousUrl()
    {
        return $_SERVER['HTTP_REFERER'];
    }
}
