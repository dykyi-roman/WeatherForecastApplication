<?php

namespace Dykyi\Response;

use Dykyi\CommandBus\Formatter\ConsoleFormatter;
use Dykyi\Helpers\TextBuilder;
use Dykyi\ValueObjects\Weather;

/**
 * Class CliResponse
 * @package Dykyi\Response
 */
class CliResponse implements ResponseInterface
{
    /**
     * @param array $data
     * @return string
     */
    public function response(array $data): string
    {
        $text = TextBuilder::create();
        $text->add('City      | Date      | Temperature');
        /** @var Weather $weather */
        foreach ($data as $weather) {
            $text->add($weather->getCity() . '    |' . $weather->getDate() . ' | ' . $weather->getTemperature());
        }

        return ConsoleFormatter::create()->format($text);
    }
}