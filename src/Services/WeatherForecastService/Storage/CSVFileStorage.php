<?php

namespace Dykyi\Services\WeatherForecastService\Storage;

use Dykyi\ValueObjects\Weather;

/**
 * Class CSVFileRepository
 * @package Dykyi\Services\WeatherForecastService\Repository
 */
class CSVFileStorage implements FileStorageInterface
{
    /**
     * @param string $fileName
     * @param array $data
     *
     * @return bool
     */
    public function save(string $fileName, array $data): bool
    {
        $fp = fopen($fileName, 'w');

        /** @var Weather $field */
        foreach ($data as $weather) {
            fputcsv($fp, [
                $weather->getCity(),
                $weather->getDate(),
                $weather->getTemperature(),
            ]);
        }
        fclose($fp);

        return true;
    }
}