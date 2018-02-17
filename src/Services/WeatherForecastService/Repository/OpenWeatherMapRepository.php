<?php

namespace Dykyi\Services\WeatherForecastService\Repository;

use GuzzleHttp\Client;

/**
 * Class OpenWeatherMapRepository
 * @package Dykyi\Services\WeatherForecastService\Repository
 */
class OpenWeatherMapRepository implements WeatherRepositoryInterface
{
    private $options;

    public function __construct(array $options)
    {
        $this->options = $options;
    }

    public function getWeatherByName(string $cityName)
    {
        //TODO: API connect and get data
        $client = new Client();
        $res = $client->request('GET', sprintf($this->options['url'],$cityName, $this->options['key']));
        $body = $res->getBody();
        
        return (string)$body;
    }
}