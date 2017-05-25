<?php

namespace App\Core;

use Psr\Http\Message\StreamInterface;

class Stream implements StreamInterface
{
    private $stream;

    public function __construct($stream)
    {
        if (!is_resource($stream))
            throw new \Exception("Invalid type of stream: $stream");

        $this->stream = $stream;
        $meta = stream_get_meta_data($this->stream);

//        var_dump($meta);
    }

    public function __toString()
    {
        // TODO: Implement __toString() method.
    }

    public function close()
    {
        // TODO: Implement close() method.
    }

    public function detach()
    {
        // TODO: Implement detach() method.
    }

    public function eof()
    {
        // TODO: Implement eof() method.
    }

    public function getContents()
    {
        // TODO: Implement getContents() method.
    }

    public function getMetadata($key = null)
    {
        // TODO: Implement getMetadata() method.
    }

    public function getSize()
    {
        // TODO: Implement getSize() method.
    }

    public function isReadable()
    {
        // TODO: Implement isReadable() method.
    }

    public function isSeekable()
    {
        // TODO: Implement isSeekable() method.
    }

    public function isWritable()
    {
        // TODO: Implement isWritable() method.
    }

    public function read($length)
    {
        // TODO: Implement read() method.
    }

    public function rewind()
    {
        // TODO: Implement rewind() method.
    }

    public function seek($offset, $whence = SEEK_SET)
    {
        // TODO: Implement seek() method.
    }

    public function tell()
    {
        // TODO: Implement tell() method.
    }

    public function write($string)
    {
        // TODO: Implement write() method.
    }
}