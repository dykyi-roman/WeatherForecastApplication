<?php

namespace Dykyi\Services\WeatherForecastService\Repository;

/**
 * Interface WeatherRepositoryInterface
 * @package Dykyi\Repository
 */
final class WeatherRepositoryFactory
{
    /**
     * @param string $service
     * @param array $options
     * @return WeatherRepositoryInterface
     */
    public static function create(string $service, array $options): WeatherRepositoryInterface
    {
        switch ($service) {
            case WeatherRepositoryInterface::OPEN_WEATHER_MAP:
                $object = new OpenWeatherMapRepository($options);
                break;
            default:
                $object = new OpenWeatherMapRepository($options);
        }

        return $object;
    }
}