<?php

namespace Rpalladino\Lipsum\Test;

use Rpalladino\Lipsum\Service;

class ServiceTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     * @dataProvider serviceParameters
     */
    public function buildsEndpointUrlGivenParameters($parameters, $expectedUrl)
    {
        $service = new Service;
        extract($parameters);
        $this->assertEquals($expectedUrl, $service->buildUrl($what, $amount, $start));
    }

    public function serviceParameters()
    {
        return [
            [
                ["what" => null, "amount" => null, "start" => null],
                "http://www.lipsum.com/feed/json"
            ],
            [
                ["what" => "lists", "amount" => null, "start" => null],
                "http://www.lipsum.com/feed/json?what=lists"
            ],
            [
                ["what" => null, "amount" => 10, "start" => null],
                "http://www.lipsum.com/feed/json?amount=10"
            ],
            [
                ["what" => null, "amount" => null, "start" => true],
                "http://www.lipsum.com/feed/json?start=yes"
            ],
            [
                ["what" => null, "amount" => null, "start" => false],
                "http://www.lipsum.com/feed/json?start=no"
            ],
            [
                ["what" => "paras", "amount" => 2, "start" => null],
                "http://www.lipsum.com/feed/json?what=paras&amount=2"
            ],
            [
                ["what" => "words", "amount" => 250, "start" => true],
                "http://www.lipsum.com/feed/json?what=words&amount=250&start=yes"
            ],
            [
                ["what" => "words", "amount" => 250, "start" => false],
                "http://www.lipsum.com/feed/json?what=words&amount=250&start=no"
            ]
        ];
    }

    /**
     * @test
     * @group integration
     */
    public function fetchesResponseFromServiceAsObject()
    {
        $service = new Service;
        $response = $service->fetch();
        $this->assertObjectHasAttribute("lipsum", $response);
        $this->assertObjectHasAttribute("generated", $response);
        $this->assertObjectHasAttribute("creditname", $response);
        $this->assertObjectHasAttribute("creditlink", $response);
        $this->assertObjectHasAttribute("donatelink", $response);
    }
}
