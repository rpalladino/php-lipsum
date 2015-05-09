<?php

namespace Rpalladino\Lipsum;

class Lipsum
{
    private $service;

    public function __construct(Service $service = null)
    {
        $this->service = $service ?: new Service;
    }

    public function getText(array $options = array())
    {
        extract($options);
        $what   = isset($what)   ? $what   : null;
        $amount = isset($amount) ? $amount : null;
        $start  = isset($start)  ? $start  : null;

        $response = $this->service->fetch($what, $amount, $start);
        return $response->lipsum;
    }

    public function getParagraphs($amount = 5, $start = true)
    {
        $what = "paras";
        return $this->getText(compact('what', 'amount', 'start'));
    }

    public function getWords($amount = 5, $start = true)
    {
        $what = "words";
        return $this->getText(compact('what', 'amount', 'start'));
    }

    public function getBytes($amount = 5, $start = true)
    {
        $what = "bytes";
        return $this->getText(compact('what', 'amount', 'start'));
    }

    public function getLists($amount = 5, $start = true)
    {
        $what = "lists";
        return $this->getText(compact('what', 'amount', 'start'));
    }
}
