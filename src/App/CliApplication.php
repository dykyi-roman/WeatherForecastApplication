<?php

namespace Dykyi\App;

use Dykyi\CommandBus\CommandBus;
use Dykyi\ValueObjects\CommandInput;

/**
 * Class CliApplication
 * @package Dykyi
 */
final class CliApplication implements ApplicationInterface
{
    public function run()
    {
        $input = new CommandInput();
        $commandBus = CommandBus::create();
        $command = $commandBus->getCommandByInput($input);
        $commandBus->handle($command);
    }
}
