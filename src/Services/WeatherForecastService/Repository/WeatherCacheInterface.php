<?php

namespace Dykyi\Services\WeatherForecastService\Repository;

/**
 * Interface WeatherCacheInterface
 * @package Dykyi\Clients
 */
interface WeatherCacheInterface
{
    public function save($data);
}