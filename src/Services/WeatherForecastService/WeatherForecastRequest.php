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
    private $outputFile;

    public function __construct(string $cityName, string $responseFormat, $outputFile)
    {
        $this->city           = new City($cityName);
        $this->responseFormat = $responseFormat;
        $this->outputFile     = $outputFile;
    }

    public function getCity(): City
    {
        return $this->city;
    }

    public function getResponseFormat(): string
    {
        return $this->responseFormat;
    }

    public function getOutputFile()
    {
        return $this->outputFile;
    }

    public function getOutputFileExt()
    {
        //TODO: some logic
        $format = explode('.', $this->getOutputFile());
        if (count($format) !== 2) {
            throw new \InvalidArgumentException();
        }

        return $format[1];
    }

}