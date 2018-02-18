<?php

namespace Dykyi\Services\WeatherForecastService;

use Dykyi\Services\Events\Event\SaveFileInTheStorageEvent;
use Dykyi\Services\Service;
use Dykyi\Services\WeatherForecastService\Repository\WeatherClientInterface;
use Dykyi\Services\WeatherForecastService\Storage\Storage;
use Dykyi\ValueObjects\Weather;
use Stash\Interfaces\DriverInterface;
use Stash\Pool;

/**
 * Class WeatherForecastService
 * @package Dykyi\Service
 */
class WeatherForecastService extends Service
{
    /** @var WeatherClientInterface */
    private $client;

    /** @var DriverInterface */
    private $cache;

    public function __construct(WeatherClientInterface $client, DriverInterface $cache)
    {
        parent::__construct();
        $this->client = $client;
        $this->cache  = new Pool($cache);
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
        $item = $this->cache->getItem($request->getCity()->getName());
        if($item->isMiss()){
            $data = $this->client->getWeatherByCityName($request->getCity()->getName());
            $item->lock();
            $item->set($data);
            $item->expiresAfter(getenv('CACHE_EXPIRE'));
            $this->cache->save($item);
        }

        $result = $this->convert($item->get() === null ? $data : $item->get());
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