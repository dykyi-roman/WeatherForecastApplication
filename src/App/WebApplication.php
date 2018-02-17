<?php

namespace Dykyi\App;

use Dykyi\CommandBus\Command\WeatherForecast;
use Dykyi\CommandBus\CommandBus;
use Dykyi\Response\ResponseInterface;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class WebApplication
 * @package Dykyi
 */
final class WebApplication implements ApplicationInterface
{
    public function run()
    {
//        $cityName = (new Request())->get('cityName');
//        if ($cityName) {
        $cityName = 'Kiev';
            $commandBus = CommandBus::create();
            $commandBus->handle(new WeatherForecast($cityName, ResponseInterface::WEB));
//        }
    }
}
