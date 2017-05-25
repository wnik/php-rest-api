<?php

namespace App\Core;


use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\UriInterface;

class Request extends Message implements RequestInterface
{
    private $uri;
    private $method;
    private $requestTarget;
    private $methods = [
        'GET',
        'PUT',
        'DELETE',
        'POST',
        'HEAD'
    ];

    public function __construct(UriInterface $uri, string $method, array $headers = [], string $protocol, string $body = '')
    {
        if (!$this->isValidMethod($method)) {
            throw new \Exception("Method $method is not valid");
        }

        $this->uri = $uri;
        $this->method = $method;
        $this->headers = $headers;
        $this->protocol = $protocol;

        $stream = fopen('php://temp', 'r+');
        fwrite($stream, $body);
        fseek($stream, 0);
        $this->body = new Stream($stream);
    }

    public function getMethod()
    {
        return $this->method;
    }

    public function getRequestTarget()
    {
        if (isset($this->requestTarget) && $this->requestTarget !== '') {
            return $this->requestTarget;
        } else {
            $uri = $this->uri->getPath();
            $uri = rtrim($uri, '/');

            if ($uri === '') {
                $uri = '/';
            }

            $query = $this->uri->getQuery();

            if ($query !== '') {
                $uri .= '?' . $query;
            }

            return $uri;
        }
    }

    public function getUri()
    {
        return $this->uri;
    }

    public function withMethod($method)
    {
        if (!$this->isValidMethod($method)) {
            throw new \InvalidArgumentException('Request method $method is not valid');
        }

        $this->method = $method;

        return $this;
    }

    public function withRequestTarget($requestTarget)
    {
        // TODO: Implement withRequestTarget() method.
    }

    public function withUri(UriInterface $uri, $preserveHost = false)
    {
        // TODO: Implement withUri() method.
    }

    public function isValidMethod($method): bool
    {
        return in_array(strtoupper($method), $this->methods);
    }
}

