<?php

namespace Rpalladino\Lipsum;

class Lipsum
{
    private $service;

    public function __construct(Service $service = null)
    {
        $this->service = $service ?: new Service;
    }

    public function getText($what = null, $amount = null, $start = null)
    {
        $response = $this->service->fetch($what, $amount, $start);
        return $response->lipsum;
    }

    public function getParagraphs($amount = null, $start = null)
    {
        return $this->getText("paras", $amount, $start);
    }

    public function getWords($amount = null, $start = null)
    {
        return $this->getText("words", $amount, $start);
    }

    public function getBytes($amount = null, $start = null)
    {
        return $this->getText("bytes", $amount, $start);
    }

    public function getLists($amount = null, $start = null)
    {
        return $this->getText("lists", $amount, $start);
    }
}
