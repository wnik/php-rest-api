<?php

namespace App\Core;

use Psr\Http\Message\UriInterface;

class Uri implements UriInterface
{
    private $host;
    private $path;
    private $query;
    private $port;
    private $scheme;
    private $userInfo;
    private $fragment;

    public function __construct(string $uri)
    {
        if (!is_string($uri) || $uri === '') {
            throw new \Exception("Given uri: $uri must be a string or cannot be empty");
        }

        $uri = parse_url($uri);
        $this->setUriParams($uri);
    }

    public function setUriParams(array $parsedUri)
    {
        $this->host = $parsedUri['host'] ?? '';
        $this->path = $parsedUri['path'] ?? '/';
        $this->query = $parsedUri['query'] ?? '';
        $this->port = $parsedUri['port'] ?? 80;
        $this->scheme = $parsedUri['scheme'] ?? '';

        // TODO: USERINFO & FRAGMENT
        $this->userInfo = '';
        $this->fragment = '';
    }

    public static function createFromParts(array $uriParts): string
    {
        $scheme = $uriParts['REQUEST_SCHEME'] ?? '';
        $port = $uriParts['SERVER_PORT'] ?? '';
        $port = ($port === '80' || $port === '443') ? '' : ':' . $port;
        $host = $uriParts['HTTP_HOST'] ?? '';
        $path = $uriParts['REQUEST_URI'] ?? '';

        $uri = $scheme . '://' . $host . $port . $path;

        return $uri;
    }

    public function __toString()
    {
        // TODO: Implement __toString() method.
    }

    public function getAuthority()
    {
        // TODO: Implement getAuthority() method.
    }

    public function getFragment()
    {
        // TODO: Implement getFragment() method.
    }

    public function getHost()
    {
        return strtolower($this->host) ?? '';
    }

    public function getPath()
    {
        return $this->path;
    }

    public function getPort()
    {
        return $this->port;
    }

    public function getQuery()
    {
        return $this->query;
    }

    public function getScheme()
    {
        return $this->scheme;
    }

    public function getUserInfo()
    {
        // TODO: Implement getUserInfo() method.
    }

    public function withFragment($fragment)
    {
        // TODO: Implement withFragment() method.
    }

    public function withHost($host)
    {
        // TODO: Implement withHost() method.
    }

    public function withPath($path)
    {
        // TODO: Implement withPath() method.
    }

    public function withPort($port)
    {
        // TODO: Implement withPort() method.
    }

    public function withQuery($query)
    {
        // TODO: Implement withQuery() method.
    }

    public function withScheme($scheme)
    {
        // TODO: Implement withScheme() method.
    }

    public function withUserInfo($user, $password = null)
    {
        // TODO: Implement withUserInfo() method.
    }
}