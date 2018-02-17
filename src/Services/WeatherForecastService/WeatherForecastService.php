<?php

namespace Dykyi\Services\WeatherForecastService;

use Dykyi\Services\Service;
use Dykyi\Services\WeatherForecastService\Repository\WeatherRepositoryInterface;

/**
 * Class WeatherForecastService
 * @package Dykyi\Service
 */
class WeatherForecastService extends Service
{
    /** @var WeatherRepositoryInterface */
    private $repository;

    public function __construct(WeatherRepositoryInterface $repository)
    {
        parent::__construct();
        $this->repository = $repository;
    }

    private function converter($city, array $data)
    {
        //TODO: Convert API response to Weather objects
//        new Weather($city,'','');
        return [];
    }

    /**
     * @param WeatherForecastRequest $request
     * @return array
     */
    public function execute(WeatherForecastRequest $request): array
    {
        $city = $request->getCity()->getName();
        $data = $this->repository->getWeatherByName($city);

        return $this->converter($city, $data);
    }
}