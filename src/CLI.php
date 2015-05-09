<?php

namespace Rpalladino\Lipsum;

use Rpalladino\Lipsum\Command;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\Input\InputInterface;

class CLI extends Application
{
    protected function getCommandName(InputInterface $input)
    {
        return "lipsum";
    }

    protected function getDefaultCommands()
    {
        return array_merge(parent::getDefaultCommands(), [new Command]);
    }

    /**
     * Overridden so that the application doesn't expect the command
     * name to be the first argument.
     */
    public function getDefinition()
    {
        $inputDefinition = parent::getDefinition();
        $inputDefinition->setArguments();

        return $inputDefinition;
    }
}
