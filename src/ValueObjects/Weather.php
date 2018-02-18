<?php

namespace Dykyi\ValueObjects;

use DateTime;
use Dykyi\Helpers\WeatherHelper;

/**
 * Class WeatherHelper
 * @package Dykyi\ValueObjects
 */
class Weather
{
    const DATE_FORMAT = 'Y-m-d';

    private $city;
    private $date;
    private $temperature;

    public function __construct(string $city, DateTime $date, string $temp)
    {
        $this->city = $city;
        $this->date = $date;
        $this->temperature = $temp;
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
        return$this->temperature;
    }

}