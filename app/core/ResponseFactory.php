<?php

namespace App\Core;

use Psr\Http\Message\ResponseInterface;

class ResponseFactory
{
    public function create(): ResponseInterface
    {
        return new Response(200, ['Content-Type' => 'text/html; charset=UTF-8'], $_SERVER['SERVER_PROTOCOL']);
    }
}