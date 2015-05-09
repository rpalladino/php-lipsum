<?php

namespace Rpalladino\Lipsum\Test;

use Rpalladino\Lipsum\Lipsum;

class LipsumTest extends \PHPUnit_Framework_TestCase
{
    private $lipsum;

    public function setUp()
    {
        $this->lipsum = new Lipsum;
    }

    /**
     * @test
     * @dataProvider serviceArguments
     */
    public function usesServiceToGetText($what, $amount, $start)
    {
        $service = $this->prophesize("Rpalladino\Lipsum\Service");
        $service->fetch($what, $amount, $start)->willReturn((object) ["lipsum" => ""]);

        $lipsum = new Lipsum($service->reveal());
        $text = $lipsum->getText($what, $amount, $start);

        $service->fetch($what, $amount, $start)->shouldHaveBeenCalled();
    }

    public function serviceArguments()
    {
        return [
            [null, null, null],
            ["bytes", null, null],
            [null, 30, null],
            [null, null, false],
            ["words", 50, null],
            ["paras", 10, false],
        ];
    }

    /**
     * @test
     * @group integration
     */
    public function getsTextUsingDefaults()
    {
        $this->assertInternalType('string', $this->lipsum->getText());
    }

    /**
     * @test
     * @group integration
     * @dataProvider kindsOfText
     */
    public function getsTextStartingWithLoremIpsum($what)
    {
        $this->assertStringStartsWith(
            "Lorem ipsum dolor sit amet",
            $this->lipsum->getText($what, null, true)
        );
    }

    /**
     * @test
     * @group integration
     * @dataProvider kindsOfText
     */
    public function getsTextStartingWithoutLoremIpsum($what)
    {
        $this->assertStringStartsNotWith(
            "Lorem ipsum dolor sit amet",
            $this->lipsum->getText($what, null, false)
        );
    }

    public function kindsOfText()
    {
        return [["paras"], ["words"], ["bytes"], ["lists"]];
    }

    /**
     * @test
     * @group integration
     */
    public function getsSpecifiedAmountOfParagraphs()
    {
        $this->assertEquals(5, lineCount($this->lipsum->getParagraphs(5)));
    }

    /**
     * @test
     * @group integration
     */
    public function getsSpecifiedAmountOfWords()
    {
        $this->assertEquals(25, str_word_count($this->lipsum->getWords(25)));
    }

    /**
     * @test
     * @group integration
     */
    public function getsSpecifiedAmountOfBytes()
    {
        $this->assertEquals(256, strlen($this->lipsum->getBytes(256)));
    }

    /**
     * @test
     * @group integration
     */
    public function getsSpecifiedAmountOfListItems()
    {
        $this->assertEquals(5, lineCount($this->lipsum->getLists(5)));
    }
}

function lineCount($text)
{
    return substr_count($text, "\n") + 1;
}
