<?php

namespace Rpalladino\Lipsum\Test;

use Rpalladino\Lipsum\Command;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\Tester\CommandTester;

/**
 * @group integration
 */
class CommandTest extends \PHPUnit_Framework_TestCase
{
    private $command;
    private $commandTester;

    public function setUp()
    {
        $app = new Application;
        $app->add(new Command);

        $this->command = $app->find("lipsum");
        $this->commandTester = new CommandTester($this->command);
    }

    /**
     * @test
     */
    public function itExecutes()
    {
        $this->commandTester->execute(['command' => $this->command->getName()]);
        $this->assertInternalType('string', $this->commandTester->getDisplay());
    }

    /**
     * @test
     */
    public function itCanStartWithLoremIpsum()
    {
        $this->commandTester->execute([
            "command" => $this->command->getName(),
            "--start-with-lipsum" => true
        ]);
        $this->assertStringStartsWith('Lorem ipsum', $this->commandTester->getDisplay());
    }

    /**
     * @test
     */
    public function itCanStartWithoutLoremIpsum()
    {
        $this->commandTester->execute([
            "command" => $this->command->getName(),
        ]);
        $this->assertStringStartsNotWith('Lorem ipsum', $this->commandTester->getDisplay());
    }

    /**
     * @test
     */
    public function itGetsSpecifiedAmountOfParagraphs()
    {
        $this->commandTester->execute([
            "command" => $this->command->getName(),
            "--amount" => 3,
            "--what" => "paras"
        ]);
        $this->assertCount(3, explode("\n", trim($this->commandTester->getDisplay())));
    }

    /**
     * @test
     */
    public function itGetsSpecifiedAmountOfWords()
    {
        $this->commandTester->execute([
            "command" => $this->command->getName(),
            "--amount" => 5,
            "--what" => "words"
        ]);
        $this->assertCount(5, explode(" ", trim($this->commandTester->getDisplay())));
    }

    /**
     * @test
     */
    public function itGetsSpecifiedAmountOfBytes()
    {
        $this->commandTester->execute([
            "command" => $this->command->getName(),
            "--amount" => 256,
            "--what" => "bytes"
        ]);
        $this->assertEquals(256, strlen(trim($this->commandTester->getDisplay())));
    }

    /**
     * @test
     */
    public function itGetsSpecifiedAmountOfListItems()
    {
        $this->commandTester->execute([
            "command" => $this->command->getName(),
            "--amount" => 3,
            "--what" => "lists"
        ]);
        $this->assertCount(3, explode("\n", trim($this->commandTester->getDisplay())));
    }
}
