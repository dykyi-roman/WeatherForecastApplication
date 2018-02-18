<?php

namespace Dykyi\Services\Events\Event;

use Dykyi\Services\WeatherForecastService\Storage\FileStorageInterface;
use Symfony\Component\EventDispatcher\Event;

/**
 * Class SaveFileInTheStorageEvent
 * @package Dykyi\Services\Events\Event
 */
class SaveFileInTheStorageEvent extends Event
{
    private $storage;
    private $fileName;
    private $data;

    public function __construct(FileStorageInterface $storage, string $fileName, array $data)
    {
        $this->storage  = $storage;
        $this->fileName = $fileName;
        $this->data     = $data;
    }

    public function getFileName(): string
    {
        return $this->fileName;
    }

    public function getStorage(): FileStorageInterface
    {
        return $this->storage;
    }

    public function getData(): array
    {
        return $this->data;
    }

}