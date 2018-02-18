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
    const SEPARATE = 12;

    private function setSpace($word, $count)
    {
        $c = $count - strlen($word);
        while($c--)
        {
            $word .= ' ';
        }

        return $word;
    }

    /**
     * @param array $data
     * @return string
     */
    public function response(array $data): string
    {
        $text = TextBuilder::create();
        $text->add('City         | Date         | Temperature');
        /** @var Weather $weather */
        foreach ($data as $weather) {
            $text->add(
                $this->setSpace($weather->getCity(), self::SEPARATE) .  ' | ' .
                $this->setSpace($weather->getDate(),self::SEPARATE) . ' | ' .
                $this->setSpace($weather->getTemperature(), self::SEPARATE));
        }

        return ConsoleFormatter::create()->format($text);
    }
}