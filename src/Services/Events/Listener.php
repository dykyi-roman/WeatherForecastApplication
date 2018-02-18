<?php

namespace Dykyi\Services\Events;

use Dykyi\Services\Events\Event\SaveFileInTheStorageEvent;
use Dykyi\Services\WeatherForecastService\Storage\Storage;
use Psr\Log\LoggerAwareInterface;
use Psr\Log\LoggerInterface;
use Psr\Log\NullLogger;
use Symfony\Component\EventDispatcher\Event;

/**
 * Class Listener
 * @package Dykyi\Services\Events
 */
class Listener implements LoggerAwareInterface
{
    /** @var LoggerInterface|NullLogger  */
    protected $logger;

    /**
     * @param SaveFileInTheStorageEvent $event
     */
    public function onSaveWeatherToFileAction(SaveFileInTheStorageEvent $event)
    {
        $event->getStorage()->save($event->getFileName(), $event->getData());
        $this->logger->info('File is export');
    }

    /**
     * Sets a logger instance on the object.
     *
     * @param LoggerInterface $logger
     *
     * @return void
     */
    public function setLogger(LoggerInterface $logger = null)
    {
        $this->logger = $logger ?? new NullLogger();
    }
}