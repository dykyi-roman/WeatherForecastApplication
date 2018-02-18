<?php

namespace Dykyi\Helpers;

/**
 * Class WeatherHelper
 * @package Dykyi\Helpers
 */
class WeatherHelper
{
    public static function fahrenheitToCelsius($fahrenheit)
    {
        return ($fahrenheit - 32) / 1.8;
    }

    public static function celsiusToFahrenheit($celsius)
    {
        return ($celsius * 9/5) + 32;
    }
}