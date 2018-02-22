<?php

namespace Dykyi\Services\WeatherForecastService\Clients;

/**
 * Interface WeatherClientFactory
 * @package Dykyi\Clients
 */
final class WeatherClientFactory
{
    /**
     * @param string $service
     * @param array $options
     * @return WeatherClientInterface
     */
    public static function create(string $service, array $options): WeatherClientInterface
    {
        switch ($service) {
            case WeatherClientInterface::OPEN_WEATHER_MAP:
                $object = new OpenWeatherMapClient($options);
                break;
            default:
                $object = new OpenWeatherMapClient($options);
        }

        return $object;
    }
}