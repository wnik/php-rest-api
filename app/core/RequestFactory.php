<?php

namespace App\Core;

use Psr\Http\Message\RequestInterface;

class RequestFactory
{
    public function create(): RequestInterface
    {
        $uriPath = Uri::createFromParts($_SERVER);
        $uri = new Uri($uriPath);
        $headers = getallheaders();

        return new Request($uri, $_SERVER['REQUEST_METHOD'], $headers, $_SERVER['SERVER_PROTOCOL']);
    }
}