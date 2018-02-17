<?php

namespace Dykyi\Services\WeatherForecastService\Storage;

/**
 * Class StorageFactory
 * @package Dykyi\Services\WeatherForecastService\Repository
 */
class StorageFactory
{
    const FILE_CSV = 'csv';
    const FILE_XML = 'xml';
    const FILE_TXT = 'txt';

    /**
     * @param string $fileFormat
     * @return CSVFileStorage|TXTFileStorage|XMLFileStorage
     */
    public static function create(string $fileFormat)
    {
        switch ($fileFormat) {
            case self::FILE_CSV:
                $repository = new CSVFileStorage();
                break;
            case self::FILE_XML:
                $repository = new XMLFileStorage();
                break;
            default:

                $repository = new TXTFileStorage();
                break;
        }
        return $repository;
    }
}