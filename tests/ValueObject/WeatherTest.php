<?php

use PHPUnit\Framework\TestCase;

/**
 * Class CommandInputTest
 *
 * @coversDefaultClass Weather
 */
class WeatherTest extends TestCase
{
    public function serviceProvider(): array
    {
        return [
            ['', 1],
            ['Kiev', -4],
            ['London', 0]
        ];
    }


    /**
     *
     * @dataProvider serviceProvider
     *
     * @param string $city
     * @param int $temperature
     */
    public function testInputData(string $city, int $temperature)
    {
        $weather = new \Dykyi\ValueObjects\Weather($city, new DateTime(), $temperature);

        $this->assertSame($weather->getCity(), $city);
        $this->assertSame($weather->getTemperature(), (string)$temperature);
        $this->assertSame($weather->getDate(), (new DateTime())->format('Y-m-d'));
    }
}