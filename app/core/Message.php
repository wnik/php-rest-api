<?php

namespace App\Core;

use Psr\Http\Message\MessageInterface;
use Psr\Http\Message\StreamInterface;

class Message implements MessageInterface
{
    protected $headers = [];
    protected $protocol;
    protected $body;

    public function getBody()
    {
        if (isset($this->body))
            return $this->body;
        else
            throw new \Exception('Stream is not set');
    }

    public function getHeader($name)
    {
        if (isset($this->headers[$name]))
            return $this->headers[$name];
        else
            return [];
    }

    public function getHeaderLine($name)
    {
        return implode('.', $this->headers);
    }

    public function getHeaders()
    {
        return $this->headers;
    }

    public function getProtocolVersion()
    {
        return $this->protocol;
    }

    public function withBody(StreamInterface $body)
    {
        $this->body = $body;
        return $this;
    }

    public function withHeader($name, $value)
    {
        // TODO: Implement withHeader() method.
    }

    public function withProtocolVersion($version)
    {
        // TODO: Implement withProtocolVersion() method.
    }

    public function withAddedHeader($name, $value)
    {
        // TODO: Implement withAddedHeader() method.
    }

    public function hasHeader($name)
    {
        return isset($this->headers[$name]);
    }

    public function withoutHeader($name)
    {
        // TODO: Implement withoutHeader() method.
    }
}