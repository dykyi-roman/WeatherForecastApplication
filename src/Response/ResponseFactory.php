<?php

namespace Dykyi\Response;

/**
 * Class ResponseFactory
 * @package Dykyi
 */
final class ResponseFactory
{
    /**
     * @param string $responseFormat
     * @return ResponseInterface
     */
    public static function create(string $responseFormat): ResponseInterface
    {
        switch ($responseFormat) {
            case ResponseInterface::WEB:
                $object = new WebResponse();
                break;
            case ResponseInterface::CONSOLE:
                $object = new CliResponse();
                break;
            default:
                $object = new CliResponse();
        }

        return $object;
    }
}
