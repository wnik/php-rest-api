<?php

namespace App\Core;

use App\Config\Config;


class App
{
    private $config;
    private $router;


    public function __construct(Config $config)
    {
        $this->config = $config;
        $this->router = new Router();
    }

    public function get(string $pattern, array $argumentsPatterns = [], \Closure $callback)
    {
        $route = $this->router->createRoute($pattern, $argumentsPatterns, 'GET', $callback);
        $this->router->add($route);
    }

    public function run()
    {
        $this->router->match((new RequestFactory())->create(), (new ResponseFactory())->create(), function () {
            echo 'xd';
        });
    }
}