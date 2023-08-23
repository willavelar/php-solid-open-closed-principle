<?php
class Logger
{
    private $writer;

    public function __construct(Writer $writer)
    {
        $this->writer = $writer;
    }

    public function write($message)
    {
        $this->writer->write($message);
    }
}