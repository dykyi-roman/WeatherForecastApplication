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
    private $outputFileFormat;

    /**
     * WeatherForecast constructor.
     *
     * @param string $cityName
     * @param null $responseFormat
     * @param null $outputFileFormat
     */
    public function __construct(string $cityName, $outputFileFormat = null, $responseFormat = null)
    {
        $this->cityName         = $cityName;
        $this->responseFormat   = $responseFormat ?? ResponseInterface::CONSOLE;
        $this->outputFileFormat = $outputFileFormat;
    }

    public function getCityName(): string
    {
        return $this->cityName;
    }

    public function getResponseFormat(): string
    {
        return $this->responseFormat;
    }

    public function getOutputFileFormat()
    {
        return $this->outputFileFormat;
    }

    public function name()
    {
        return __CLASS__;
    }
}