<?php

namespace Dykyi\Services\WeatherForecastService\Repository;

use GuzzleHttp\Client as GuzzleClient;
use Dykyi\Services\WeatherForecastService\Response\ResponseDataExtractor;

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

    /**
     * @param string $name
     * @return array|null
     */
    public function getWeatherByCityName(string $name)
    {
        $client = new GuzzleClient();
        $response = $client->request('GET', $this->options['url'], [
            'query' => [
                'q'     => $name,
                'units' => 'metric',
                'APPID' => $this->options['key']
            ]
        ]);

        $content = null;
        if ($response->getStatusCode() === 200)
        {
            $extractor = new ResponseDataExtractor();
            $content = $extractor->extract($response);
        }

        return $content;
    }

}