<?php

namespace App\Core;

use Psr\Http\Message\StreamInterface;

class Stream implements StreamInterface
{
    private $stream;
    private $size;

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
        if (!$this->size) {
            $stats = fstat($this->stream);
            $this->size = $stats['size'];
        }

        return $this->size;
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
        $data = fread($this->stream, $length);

        if ($data === false) {
            throw new \Exception('Cannot read from stream');
        }

        return $data;
    }

    public function rewind()
    {
        if (rewind($this->stream) === false) {
            throw new \Exception('Cannot rewind');
        }
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
        $data = fwrite($this->stream, $string);

        if ($data === false) {
            throw new \Exception('Cannot wirte to stream');
        }

        $this->size = null;

        return $data;
    }
}