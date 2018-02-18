<?php

namespace Dykyi\CommandBus\Handler;

use Dykyi\Response\ResponseFactory;
use Dykyi\CommandBus\Command\WeatherForecast;
use Dykyi\Services\WeatherForecastService\Repository\RedisCache;
use Dykyi\Services\WeatherForecastService\Repository\WeatherClientFactory;
use Dykyi\Services\WeatherForecastService\WeatherForecastRequest;
use Dykyi\Services\WeatherForecastService\WeatherForecastService;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class WeatherForecastCommandHandler
 * @package Dykyi\Command\Handler
 */
class WeatherForecastCommandHandler
{
    public function handle(WeatherForecast $command)
    {
        try {
            $request = new WeatherForecastRequest(
                $command->getCityName(),
                $command->getResponseFormat(),
                $command->getOutputFile()
            );

            $client = WeatherClientFactory::create(
                getenv('API_SERVICE'),
                [
                    'url' => getenv('API_URL'),
                    'key' => getenv('API_KEY')
                ]
            );

            $service = new WeatherForecastService($client, new RedisCache());
            $data = $service->execute($request);

            $responseObject = ResponseFactory::create($request->getResponseFormat());
            $response = new Response($responseObject->response($data));
            $response->send();

        } catch (\InvalidArgumentException $exception) {
            $response = new Response($exception->getMessage());
            $response->send();
        } catch (\Throwable $exception) {
            throw $exception;
        }
    }
}