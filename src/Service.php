<?php

namespace Rpalladino\Lipsum;

/**
 * Provides an interface to the {@link http://www.lipsom.com} service.
 */
class Service
{
    /**
     * @var string www.lipsum.com service endpoint
     */
    const BASE_URL = "http://www.lipsum.com/feed/json";

    /**
     * Build a URL to the www.lipsum.com service endpoint
     *
     * @internal
     * 
     * @param  string  $what   Kind of text to generate [paras|words|bytes|lists] 
     * @param  int     $amount Amount of text to generate
     * @param  boolean $start  Should text start with "Lorem ipsum..."?
     * 
     * @return string          URL to www.lipsum.com service
     */
    public function buildUrl($what = null, $amount = null, $start = null)
    {
        if (isset($start)) {
            $start = $start ? 'yes' : 'no';
        }

        $query = http_build_query(compact('what', 'amount', 'start'));
        return self::BASE_URL . ($query ? '?' . $query : '');
    }

    /**
     * Retrieve generated text from wwww.lipsum.com service
     * 
     * @api
     *
     * @uses   file_get_contents() to handle http GET requests to www.lipsum.com
     * 
     * @param  string  $what   Kind of text to generate [paras|words|bytes|lists] 
     * @param  int     $amount Amount of text to generate
     * @param  boolean $start  Should text start with "Lorem ipsum..."?
     * 
     * @return string          Generated text from www.lipsum.com
     */
    public function fetch($what = null, $amount = null, $start = null)
    {
        $url = $this->buildUrl($what, $amount, $start);
        $response = file_get_contents($url);
        return json_decode($response)->feed;
    }
}
