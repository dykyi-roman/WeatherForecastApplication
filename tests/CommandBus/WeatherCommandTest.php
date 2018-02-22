<?php

use PHPUnit\Framework\TestCase;

/**
 * Class WeatherCommandTest
 *
 * @coversDefaultClass WeatherForecast
 */
class WeatherCommandTest extends TestCase
{
    const NAME = 'Kiev';

    public function testItSetACityName()
    {
        $command = new \Dykyi\CommandBus\Command\WeatherForecast(self::NAME);
        $this->assertSame($command->getCityName(), self::NAME);
    }

    public function testCanNotMissTheCityName()
    {
        $this->expectException(DomainException::class);
        new \Dykyi\CommandBus\Command\WeatherForecast('');
    }

}
