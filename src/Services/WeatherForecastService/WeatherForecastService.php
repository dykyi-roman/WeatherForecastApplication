<?php

namespace Dykyi\Services\WeatherForecastService;

use Dykyi\Services\Service;
use Dykyi\Services\WeatherForecastService\Repository\WeatherRepositoryInterface;
use Dykyi\ValueObjects\Weather;

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

    private function converter($weather): array
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
        $data = $this->repository->getWeatherByCityName($request->getCity()->getName());
        return $this->converter($data);
    }
}