<?php

use PHPUnit\Framework\TestCase;

/**
 * Class CityTest
 *
 * @coversDefaultClass City
 */
class CityTest extends TestCase
{

    public function RandomString($size): string
    {
        $randstring = '';
        for ($i = 0; $i < $size; $i++) {
            $randstring .= strlen(chr(random_int(65,90)));
        }
        return $randstring;
    }
    public function testCityNotEmpty(): void
    {
        $this->expectExceptionMessage('Empty city name');
        new \Dykyi\ValueObjects\City('');
    }

    public function testCityShortName(): void
    {
        $this->expectExceptionCode(2);
        new \Dykyi\ValueObjects\City('s');
    }

    public function testCityLongName(): void
    {
        $this->expectExceptionMessage('City name is too long');
        new \Dykyi\ValueObjects\City($this->RandomString(300));
    }
}