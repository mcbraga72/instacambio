<?php

namespace br\com\InstaCambio\Model;

class ExchangePageLoadCollection
{
    private $pages;

    /**
     * ExchangePageLoadCollection constructor.
     */
    public function __construct()
    {
        $this->pages = [];
    }


    public function add($index, $htmlContent)
    {
        $this->pages[$index] = $htmlContent;
    }

    public function get($index)
    {
        if (!key_exists($index, $this->pages))
            throw new \OutOfBoundsException('Index is not set');
        
        return $this->pages[$index];
    }

    public function all()
    {
        return $this->pages;
    }
}