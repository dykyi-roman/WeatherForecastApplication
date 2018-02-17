<?php

namespace Dykyi\Formatter;

use Dykyi\Helpers\TextBuilder;

/**
 * Interface FormatterInterface
 * @package Dykyi\Formatter
 */
interface FormatterInterface
{
    /**
     * @param TextBuilder $text
     * @return string
     */
    public function format(TextBuilder $text): string;
}