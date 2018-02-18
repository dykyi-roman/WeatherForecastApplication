<?php

namespace Dykyi\CommandBus\Formatter;

use Dykyi\Helpers\TextBuilder;

/**
 * Class HtmlFormatter
 * @package Dykyi\Formatter
 */
class HtmlFormatter implements FormatterInterface
{
    /**
     * @param TextBuilder $text
     * @return string
     */
    public function format(TextBuilder $text): string
    {
        $result = '';
        foreach ($text->build() as $i => $line){
            $result .= sprintf('%s<br>', $line);
        }
        return $result;
    }

    public static function create()
    {
        return new self;
    }
}