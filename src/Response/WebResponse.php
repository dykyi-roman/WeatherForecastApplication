<?php

namespace Dykyi\Response;

/**
 * Class HTMLResponse
 * @package Dykyi\Response
 */
class WebResponse implements ResponseInterface
{
    public function response(array $data): string
    {
        return true;
    }
}