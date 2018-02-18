<?php

namespace Dykyi\Services\WeatherForecastService\Response;

use Psr\Http\Message\ResponseInterface;

/**
 * Class ResponseDataExtractor
 * @package Dykyi\Services\WeatherForecastService\Repository
 */
class ResponseDataExtractor implements ResponseDataExtractorInterface
{
    /**
     * @param  ResponseInterface $response psr-7 compliant result of http request
     * @return array data extracted from RequestInterface
     */
    public function extract(ResponseInterface $response)
    {
        $responseBody = (string)$response->getBody()->getContents();
        $rawDecoded   = json_decode($responseBody);

        if ($rawDecoded === null) {
            $oneLineResponseBody = str_replace("\n", '\n', $responseBody);
            throw new \RuntimeException(sprintf("Can't decode response: %s", $oneLineResponseBody));
        }

        return $rawDecoded;
    }
}