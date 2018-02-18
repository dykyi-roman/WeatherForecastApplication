<?php

namespace Dykyi\CommandBus\Handler;

use Dykyi\Response\ResponseFactory;
use Dykyi\CommandBus\Command\WeatherForecast;
use Dykyi\Services\Events\Event\SaveFileInTheStorageEvent;
use Dykyi\Services\WeatherForecastService\Repository\WeatherRepositoryFactory;
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
                $command->getOutputFileFormat()
            );

            $repository = WeatherRepositoryFactory::create(
                getenv('API_SERVICE'),
                [
                    'url' => getenv('API_URL'),
                    'key' => getenv('API_KEY')
                ]
            );
            $service = new WeatherForecastService($repository);
            $data = $service->execute($request);
            if (!is_null($request->getOutputFileFormat())) {
                $event = new SaveFileInTheStorageEvent($request->getOutputFileFormat(), $data);
                $service->getEventDispatcher()->dispatch('output.file.action', $event);
            }

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