<?php

namespace Dykyi\Services\WeatherForecastService\Repository;

/**
 * Interface WeatherRepositoryInterface
 * @package Dykyi\Repository
 */
interface WeatherRepositoryInterface
{
    const OPEN_WEATHER_MAP = 'openweathermap';

    public function getWeatherByCityName(string $name);
}