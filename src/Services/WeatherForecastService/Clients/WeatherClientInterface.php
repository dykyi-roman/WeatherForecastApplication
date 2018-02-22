<?php

namespace Dykyi\Services\WeatherForecastService\Clients;

/**
 * Interface WeatherClientInterface
 * @package Dykyi\Clients
 */
interface WeatherClientInterface
{
    const OPEN_WEATHER_MAP = 'openweathermap';

    public function getWeatherByCityName(string $name);
}