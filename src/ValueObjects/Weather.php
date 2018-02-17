<?php

namespace Dykyi\ValueObjects;

/**
 * Class Weather
 * @package Dykyi\ValueObjects
 */
class Weather
{
    private $city;

    private $date;

    private $temperature;

    public function __construct(string $city, string $date, string $temperature)
    {
        $this->city = $city;
        $this->date = $date;
        $this->temperature = $temperature;
    }

    /**
     * @return string
     */
    public function getCity(): string
    {
        return $this->city;
    }

    /**
     * @return string
     */
    public function getDate(): string
    {
        return $this->date;
    }

    /**
     * @return string
     */
    public function getTemperature(): string
    {
        return $this->date;
    }

}