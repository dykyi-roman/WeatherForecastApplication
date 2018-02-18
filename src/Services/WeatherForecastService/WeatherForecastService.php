<?php

namespace Dykyi\Services\WeatherForecastService;

use Dykyi\Services\Events\Event\SaveFileInTheStorageEvent;
use Dykyi\Services\Service;
use Dykyi\Services\WeatherForecastService\Repository\WeatherClientInterface;
use Dykyi\Services\WeatherForecastService\Repository\WeatherCacheInterface;
use Dykyi\Services\WeatherForecastService\Storage\Storage;
use Dykyi\ValueObjects\Weather;

/**
 * Class WeatherForecastService
 * @package Dykyi\Service
 */
class WeatherForecastService extends Service
{
    /** @var WeatherClientInterface */
    private $client;

    /** @var WeatherCacheInterface */
    private $cache;

    public function __construct(WeatherClientInterface $client, WeatherCacheInterface $cache)
    {
        parent::__construct();
        $this->client = $client;
        $this->cache  = $cache;
    }

    private function convert($weather): array
    {
        if ($weather === null) {
            return [];
        }

        $date = new \DateTime();
        $date->setTimestamp($weather->dt);

        return [new Weather($weather->name, $date, $weather->main->temp)];
    }

    /**
     * @param WeatherForecastRequest $request
     * @return array
     */
    public function execute(WeatherForecastRequest $request): array
    {
        $data = $this->client->getWeatherByCityName($request->getCity()->getName());

        $result = $this->convert($data);
        $this->cache->save($result);
        $this->saveToFile($request, $result);

        return $result;
    }

    /**
     * @param WeatherForecastRequest $request
     * @param $data
     */
    private function saveToFile(WeatherForecastRequest $request, $data)
    {
        if (!is_null($request->getOutputFile())) {
            $storage = Storage::create($request->getOutputFileExt());
            $event = new SaveFileInTheStorageEvent($storage, $request->getOutputFile(), $data);
            $this->getEventDispatcher()->dispatch('save.file.action', $event);
        }
    }
}