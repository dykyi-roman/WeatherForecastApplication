<?php

namespace Dykyi\Services\WeatherForecastService\Storage;

/**
 * Class XMLFileStorage
 * @package Dykyi\Services\WeatherForecastService\Storage
 */
class XMLFileStorage implements FileStorageInterface
{
    /**
     * @param string $fileName
     * @param array $data
     *
     * @return bool
     */
    public function save(string $fileName, array $data): bool
    {
        //TODO: save logic
        return true;
    }
}