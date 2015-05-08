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
}
