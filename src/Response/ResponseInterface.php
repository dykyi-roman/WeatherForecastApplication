<?php

namespace Dykyi\Response;

/**
 * Interface ResponseInterface
 * @package Dykyi\Reponse
 */
interface ResponseInterface
{
    const WEB      = 'web';
    const CONSOLE  = 'cli';

    public function response(array $data): string;
}