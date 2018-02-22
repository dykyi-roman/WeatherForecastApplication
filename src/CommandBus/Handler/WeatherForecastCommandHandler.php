<?php

namespace Dykyi\CommandBus\Handler;

use Dykyi\Response\ResponseFactory;
use Dykyi\CommandBus\Command\WeatherForecast;
use Dykyi\Services\WeatherForecastService\Clients\WeatherClientFactory;
use Dykyi\Services\WeatherForecastService\WeatherForecastRequest;
use Dykyi\Services\WeatherForecastService\WeatherForecastService;
use Stash\Driver\FileSystem;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class WeatherForecastCommandHandler
 * @package Dykyi\Command\Handler
 */
class WeatherForecastCommandHandler
{
    /**
     * @param WeatherForecast $command
     * @throws \Throwable
     */
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

            $service = new WeatherForecastService($client, new FileSystem());
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