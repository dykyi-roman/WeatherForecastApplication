<?php

namespace Dykyi\Response;

use Dykyi\CommandBus\Formatter\HtmlFormatter;
use Dykyi\Helpers\TextBuilder;
use Dykyi\ValueObjects\Weather;

/**
 * Class HTMLResponse
 * @package Dykyi\Response
 */
class WebResponse implements ResponseInterface
{
    public function response(array $data): string
    {
        $text = TextBuilder::create();
        /** @var Weather $weather */
        foreach ($data as $weather) {
            $text->add('City: ' . $weather->getCity());
            $text->add('Date: ' . $weather->getDate());
            $text->add('Temperature: ' . $weather->getTemperature());
        }

        return HtmlFormatter::create()->format($text);
    }
}