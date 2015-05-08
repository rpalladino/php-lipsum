<?php

namespace Rpalladino\Lipsum\Test;

use Rpalladino\Lipsum\Lipsum;

class LipsumTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     * @dataProvider textOptionsToServiceCalls
     */
    public function usesServiceToGetText($options, $what, $amount, $start)
    {
        $service = $this->prophesize("Rpalladino\Lipsum\Service");

        $lipsum = new Lipsum($service->reveal());
        $text = $lipsum->getText($options);

        $service->fetch($what, $amount, $start)->shouldHaveBeenCalled();
    }

    public function textOptionsToServiceCalls()
    {
        return [
            [[], null, null, null],
            [["what" => "bytes"], "bytes", null, null],
            [["amount" => 30,], null, 30, null],
            [["start" => false,], null, null, false],
            [["what" => "words", "amount" => 50], "words", 50, null],
            [["what" => "paras", "amount" => 10, "start" => false], "paras", 10, false],
        ];
    }

    /**
     * @test
     * @group integration
     */
    public function getsTextUsingDefaults()
    {
        $lipsum = new Lipsum;
        $this->assertInternalType('string', $lipsum->getText());
    }

    /**
     * @test
     * @group integration
     */
    public function getsTextStartingWithLoremIpsum()
    {
        $lipsum = new Lipsum;
        $startText = "Lorem ipsum dolor sit amet";
        $this->assertStringStartsWith($startText, $lipsum->getText(["start" => true]));
        $this->assertStringStartsNotWith($startText, $lipsum->getText(["start" => false]));
    }

    /**
     * @test
     * @group integration
     */
    public function getsSpecifiedAmountOfParagraphs()
    {
        $lipsum = new Lipsum;
        $paragraphs = $lipsum->getText(["what" => "paras", "amount" => 5]);
        $this->assertCount(5, explode("\n", $paragraphs));
    }

    /**
     * @test
     * @group integration
     */
    public function getsSpecifiedAmountOfWords()
    {
        $lipsum = new Lipsum;
        $words = $lipsum->getText(["what" => "words", "amount" => 25]);
        $this->assertCount(25, explode(" ", $words));
    }

    /**
     * @test
     * @group integration
     */
    public function getsSpecifiedAmountOfBytes()
    {
        $lipsum = new Lipsum;
        $bytes = $lipsum->getText(["what" => "bytes", "amount" => 256]);
        $this->assertEquals(256, strlen($bytes));
    }

    /**
     * @test
     * @group integration
     */
    public function getsSpecifiedAmountOfListItems()
    {
        $lipsum = new Lipsum;
        $lists = $lipsum->getText(["what" => "lists", "amount" => 5]);
        $this->assertCount(5, explode("\n", $lists));
    }
}
