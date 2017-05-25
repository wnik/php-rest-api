<?php

namespace App\Core;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class Router
{
    private $routes = [];


    public function add(Route $route)
    {
        $this->routes[] = $route;
    }

    public function createRoute(string $pattern, array $args, string $method, \Closure $callback): Route
    {
        return new Route($pattern, $args, $method, $callback);
    }

    public function match(RequestInterface $request, ResponseInterface $response, \Closure $callback): bool
    {
        $requestMethod = $request->getMethod();

        foreach ($this->routes as $route) {
            $routeMethod = $route->getMethod();

            if ($routeMethod !== $requestMethod) {
                return false;
            }

            $pattern = $route->getPattern();
            $uri = $request->getRequestTarget();

            if (preg_match($pattern, $uri, $matches)) {
                var_dump($matches);

                call_user_func($callback, $request, $response);

                return true;
            }
        }

        return false;
    }
}