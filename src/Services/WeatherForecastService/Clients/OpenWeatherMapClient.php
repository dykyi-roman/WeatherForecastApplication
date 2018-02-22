<?php

namespace Dykyi\Services\WeatherForecastService\Clients;

use GuzzleHttp\Client as GuzzleClient;
use Dykyi\Services\Response\ResponseDataExtractor;

/**
 * Class OpenWeatherMapClient
 * @package Dykyi\Services\WeatherForecastService\Clients
 */
class OpenWeatherMapClient implements WeatherClientInterface
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
        $content = null;
        $client  = new GuzzleClient();
        try {
            $response = $client->request('GET', $this->options['url'], [
                'query' => [
                    'q' => $name,
                    'units' => 'metric',
                    'APPID' => $this->options['key']
                ]
            ]);

            if ($response->getStatusCode() === 200)
            {
                $extractor = new ResponseDataExtractor();
                $content = $extractor->extract($response);
            }
        } catch (\Exception $exception) { }

        return $content;
    }

}