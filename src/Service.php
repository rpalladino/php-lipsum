<?php

namespace Rpalladino\Lipsum;

class Service
{
    const BASE_URL = "http://www.lipsum.com/feed/json";

    public function buildUrl($what = null, $amount = null, $start = null)
    {
        if (isset($start)) {
            $start = $start ? 'yes' : 'no';
        }

        $query = http_build_query(compact('what', 'amount', 'start'));
        return self::BASE_URL . ($query ? '?' . $query : '');
    }

    public function fetch($what = null, $amount = null, $start = null)
    {
        $url = $this->buildUrl($what, $amount, $start);
        $response = file_get_contents($url);
        return json_decode($response)->feed;
    }
}
