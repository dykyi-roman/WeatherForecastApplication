<?php

use PHPUnit\Framework\TestCase;
use \Dykyi\Services\WeatherForecastService\WeatherForecastService;
use \Dykyi\Services\WeatherForecastService\Clients\WeatherClientInterface;
use \Dykyi\Services\WeatherForecastService\WeatherForecastRequest;

/**
 * Class WeatherForecastServiceTest
 *
 * @coversDefaultClass WeatherForecastService
 */
class WeatherForecastServiceTest extends TestCase
{
    const CITY_NAME = 'Kiev';

    /** @var WeatherForecastService */
    private $service;

    public function generateApiResponse()
    {
        $main = new stdClass();
        $main->temp = 1;

        $object = new stdClass();
        $object->dt = '1171502725';
        $object->name = self::CITY_NAME;
        $object->main = $main;

        return $object;
    }

    public function setUp()
    {
        $client = $this->createMock(WeatherClientInterface::class);
        $client->method('getWeatherByCityName')->willReturn(
            $this->generateApiResponse()
        );

        $this->service = $this->getMockBuilder(WeatherForecastService::class)
            ->setConstructorArgs([$client, new \Stash\Driver\Ephemeral])
            ->setMethods(['convert'])
            ->getMock();

        $this->service->expects($this->any())
            ->method('convert')
            ->will($this->returnValue(new \Dykyi\ValueObjects\Weather(
                self::CITY_NAME,
                new DateTime(),
                10
            )));
    }

    public function testServiceExecute()
    {
        $city = $request = $this->createMock(\Dykyi\ValueObjects\City::class);
        $city->method('getName')->willReturn(self::CITY_NAME);

        $request = $this->createMock(WeatherForecastRequest::class);
        $request->method('getCity')->willReturn($city);
        $request->method('getOutputFileExt')->willReturn('csv');

        $weather = $this->service->execute($request);

        $this->assertCount(1, $weather);
        $this->assertInstanceOf(\Dykyi\ValueObjects\Weather::class, $weather[0]);
    }
}
