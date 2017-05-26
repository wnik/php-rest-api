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

    public function createRoute(string $pattern, array $argumentsPatterns, string $method, \Closure $callback): Route
    {
        return new Route($pattern, $argumentsPatterns, $method, $callback);
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

                $argumentsCount = count($matches);
                $argumentsPatternsKeys = array_keys($route->getArgumentsPatterns());
                $arguments = [];

                if ($argumentsCount > 1) {
                    array_shift($matches);
                    $arguments = array_combine($argumentsPatternsKeys, $matches);
                }

                $response = call_user_func($route->getCallback(), $request, $response, $arguments);
                call_user_func($callback, $request, $response);

                return true;
            }
        }

        return false;
    }
}