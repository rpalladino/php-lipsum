<?php

namespace Rpalladino\Lipsum;

/**
 * Main entry-point of the php-lipsum API. Provides generic method for 
 * retrieving text from the lipsum.com service and some convenience methods for 
 * partiular kinds of text.
 */
class Lipsum
{
    /**
     * @var Rpalladino\Lipsum\Service
     */
    private $service;

    /**
     * Creates a new Lipsum instance. 
     * @param Service|null $service
     */
    public function __construct(Service $service = null)
    {
        $this->service = $service ?: new Service;
    }

    /**
     * Gets lipsum text of various kinds and amounts.
     *
     * Generated text can optionally start with the traditional "Lorem ipsum 
     * dolor sit amet." If optional parameters are not specified, the service
     * defaults will be used. 
     * 
     * @param  string  $what   Kind of text to get [paras|words|bytes|lists] 
     * @param  int     $amount Amount of text to get
     * @param  boolean $start  Should text start with "Lorem ipsum..."?
     * 
     * @return string          Generated lipsum text
     */
    public function getText($what = null, $amount = null, $start = null)
    {
        $response = $this->service->fetch($what, $amount, $start);
        return $response->lipsum;
    }

    /**
     * Gets paragraphs of lipsum text in the specified amount. 
     *
     * If optional parameters are not specified, the service
     * defaults will be used.
     * 
     * @param  int     $amount Number of paragraphs to get
     * @param  boolean $start  Should text start with "Lorem ipsum..."?
     * 
     * @return string          Generated lipsum text
     */
    public function getParagraphs($amount = null, $start = null)
    {
        return $this->getText("paras", $amount, $start);
    }

    /**
     * Gets words of lipsum text in the specified amount. 
     *
     * If optional parameters are not specified, the service
     * defaults will be used.
     * 
     * @param  int     $amount Number of words to get
     * @param  boolean $start  Should text start with "Lorem ipsum..."?
     * 
     * @return string          Generated lipsum text
     */
    public function getWords($amount = null, $start = null)
    {
        return $this->getText("words", $amount, $start);
    }

    /**
     * Gets bytes of lipsum text in the specified amount. 
     *
     * If optional parameters are not specified, the service
     * defaults will be used.
     * 
     * @param  int     $amount Number of bytes to get
     * @param  boolean $start  Should text start with "Lorem ipsum..."?
     * 
     * @return string          Generated lipsum text
     */
    public function getBytes($amount = null, $start = null)
    {
        return $this->getText("bytes", $amount, $start);
    }

    /**
     * Gets lipsum text suitable for use as list items in the specified amount. 
     *
     * If optional parameters are not specified, the service
     * defaults will be used.
     * 
     * @param  int     $amount Number of list items to get
     * @param  boolean $start  Should text start with "Lorem ipsum..."?
     * 
     * @return string          Generated lipsum text
     */
    public function getLists($amount = null, $start = null)
    {
        return $this->getText("lists", $amount, $start);
    }
}
