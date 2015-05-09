<?php

namespace Rpalladino\Lipsum;

use Symfony\Component\Console\Command\Command as ConsoleCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class Command extends ConsoleCommand
{
    protected function configure()
    {
        $this->setName("lipsum")
             ->setDescription("Generate lipsum text")
             ->addOption(
                 'what',
                 'w',
                 InputOption::VALUE_REQUIRED,
                 'The kind of text to generate: paras, words, bytes, lists',
                 'paras'
             )
             ->addOption(
                 'amount',
                 'a',
                 InputOption::VALUE_REQUIRED,
                 'The amount of text to generate',
                 5
             )
             ->addOption(
                 'start-with-lipsum',
                 's',
                 InputOption::VALUE_NONE,
                 'Start generated text with "Lorem ipsum dolor sit amet."',
                 null
             );
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $lipsum = new Lipsum;

        $what   = $input->getOption("what");
        $amount = $input->getOption("amount");
        $start  = $input->getOption("start-with-lipsum");
        
        $output->writeln($lipsum->getText($what, $amount, $start));
    }
}
