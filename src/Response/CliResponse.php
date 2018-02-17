<?php

namespace Dykyi\Response;

/**
 * Class CliResponse
 * @package Dykyi\Response
 */
class CliResponse implements ResponseInterface
{
    public function response(array $data): string
    {
        //TODO: save logic
        return true;
    }
}