<?php

namespace Dykyi\App;

/**
 * Class ApplicationFactory
 * @package Dykyi
 */
final class ApplicationFactory
{
    /**
     * @param $sapi
     * @return ApplicationInterface
     */
    public static function create($sapi): ApplicationInterface
    {
        switch ($sapi) {
            case 'cli':
                $object = new CliApplication();
                break;
            default:
                $object = new WebApplication();
        }

        return $object;
    }

}
