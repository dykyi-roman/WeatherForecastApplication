<?php

namespace Dykyi\Services\Events\Event;

use Symfony\Component\EventDispatcher\Event;

/**
 * Class SaveFileInTheStorageEvent
 * @package Dykyi\Services\Events\Event
 */
class SaveFileInTheStorageEvent extends Event
{
    private $outputFileFormat;

    private $data;

    public function __construct(string $outputFileFormat, array $data)
    {
        $this->outputFileFormat = $outputFileFormat;
        $this->data = $data;
    }

    public function getOutputFileFormat(): string
    {
        return $this->outputFileFormat;
    }

    public function getData(): array
    {
        return $this->data;
    }


    public function getFileExt()
    {
        //TODO: some logic
        $format = explode('.', $this->getOutputFileFormat());
        if (count($format) !== 2) {
            throw new \InvalidArgumentException();
        }

        return $format[1];
    }
}