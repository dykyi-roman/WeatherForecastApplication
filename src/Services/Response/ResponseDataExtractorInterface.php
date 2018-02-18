<?php

namespace Dykyi\Services\Response;

use Psr\Http\Message\ResponseInterface;

/**
 * Interface ResponseDataExtractorInterface
 * @package Dykyi\Services\WeatherForecastService\Response
 */
interface ResponseDataExtractorInterface
{
    /**
     * @param  ResponseInterface   $response   psr-7 compliant result of http request
     * @return array data extracted from RequestInterface
     */
    public function extract(ResponseInterface $response);
}