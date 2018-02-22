<?php

namespace Dykyi\CommandBus\Command;

use Dykyi\Response\ResponseInterface;
use SimpleBus\Command\Command;

/**
 * Class WeatherForecast
 * @package Dykyi\Command
 */
class WeatherForecast implements Command
{
    private $cityName;
    private $responseFormat;
    private $outputFile;

    /**
     * WeatherForecast constructor.
     *
     * @param string $cityName
     * @param null $responseFormat
     * @param null $outputFile
     *
     * @throws \DomainException
     */
    public function __construct(string $cityName, $outputFile = null, $responseFormat = null)
    {
        if (empty($cityName)) {
            throw new \DomainException('Missing required "city" parameter');
        }

        $this->cityName       = $cityName;
        $this->outputFile     = $outputFile;
        $this->responseFormat = $responseFormat ?? ResponseInterface::CONSOLE;
    }

    public function getCityName(): string
    {
        return $this->cityName;
    }

    public function getResponseFormat(): string
    {
        return $this->responseFormat;
    }

    public function getOutputFile()
    {
        return $this->outputFile;
    }

    public function name()
    {
        return __CLASS__;
    }
}