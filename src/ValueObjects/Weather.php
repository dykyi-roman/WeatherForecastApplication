<?php

namespace Dykyi\ValueObjects;

use DateTime;

/**
 * Class Weather
 * @package Dykyi\ValueObjects
 */
class Weather
{
    const DATE_FORMAT = 'Y-m-d';

    private $city;
    private $date;
    private $temperature;

    public function __construct(string $city, DateTime $date, string $temperature)
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
        return $this->date->format(self::DATE_FORMAT);
    }

    /**
     * @return string
     */
    public function getTemperature(): string
    {
        return $this->temperature;
    }

}