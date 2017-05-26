<?php

namespace App\Core;

use App\Config\Config;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;


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

    public function respond(ResponseInterface $response)
    {
        header("HTTP/{$response->getProtocolVersion()} {$response->getStatusCode()} {$response->getReasonPhrase()}");

        foreach ($response->getHeaders() as $headerName => $headerValue) {
            header("$headerName: $headerValue", false);
        }

        $response->getBody()->rewind();
        $size = $response->getBody()->getSize();
        echo $response->getBody()->read($size);
    }

    public function run()
    {
        $this->router->match((new RequestFactory())->create(), (new ResponseFactory())->create(), function (RequestInterface $request, ResponseInterface $response) {
            $this->respond($response);
        });
    }
}