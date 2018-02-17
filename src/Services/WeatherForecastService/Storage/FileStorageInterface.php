<?php

namespace Dykyi\Services\WeatherForecastService\Storage;

/**
 * Interface FileStorageInterface
 * @package Dykyi\Repository
 */
interface FileStorageInterface
{
    /**
     * @param string $fileName
     * @param array $data
     * @return bool
     */
    public function save(string $fileName, array $data): bool;
}