<?php

namespace Dykyi\Services\WeatherForecastService;

use Dykyi\ValueObjects\City;

/**
 * Class WeatherForecastService
 * @package Dykyi\Services\WeatherForecastService
 */
class WeatherForecastRequest
{
    /** @var City */
    private $city;

    private $responseFormat;

    private $outputFileFormat;

    public function __construct(string $cityName, string $responseFormat, $outputFileFormat)
    {
        $this->city             = new City($cityName);
        $this->responseFormat   = $responseFormat;
        $this->outputFileFormat = $outputFileFormat;
    }

    public function getCity(): City
    {
        return $this->city;
    }

    public function getResponseFormat(): string
    {
        return $this->responseFormat;
    }

    public function getOutputFileFormat()
    {
        return $this->outputFileFormat;
    }

}