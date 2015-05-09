<?php

namespace Rpalladino\Lipsum\Test;

use Rpalladino\Lipsum\CLI;
use Symfony\Component\Console\Tester\ApplicationTester;

class CLITest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     * @group integration
     */
    public function itCanBeCalledWithoutSpecifyingTheCommand()
    {
        $cli = new CLI();
        $cli->setAutoExit(false);

        $cliTester = new ApplicationTester($cli);
        $cliTester->run([
            "--start-with-lipsum" => true,
            "--what" => "words",
            "--amount" => 5
        ]);

        $expected = "Lorem ipsum dolor sit amet.\n";
        $this->assertEquals($expected, $cliTester->getDisplay());
    }
}
