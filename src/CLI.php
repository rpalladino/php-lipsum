<?php

namespace Rpalladino\Lipsum;

use Rpalladino\Lipsum\Command;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\Input\InputInterface;

/**
 * Provides a single command application (using Symfony Console) as a CLI 
 * wrapper for the main Lipsum class. 
 */
class CLI extends Application
{
    /**
     * {@inheritDoc}
     *
     * Overridden to always return "lipsum" as the command name.
     * 
     * @internal
     */
    protected function getCommandName(InputInterface $input)
    {
        return "lipsum";
    }

    /**
     * {@inheritDoc}
     *
     * Overridden to add the Rpalladino\Lipsum\Command as a default
     *
     * @internal
     */
    protected function getDefaultCommands()
    {
        return array_merge(parent::getDefaultCommands(), [new Command]);
    }

    /**
     * {@inheritDoc}
     * 
     * Overridden so that the application doesn't expect the command
     * name to be the first argument.
     *
     * @internal
     */
    public function getDefinition()
    {
        $inputDefinition = parent::getDefinition();
        $inputDefinition->setArguments();

        return $inputDefinition;
    }
}
