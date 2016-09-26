<?php

namespace br\com\InstaCambio\Model;


abstract class ExchangeOfficeProduct
{
    private $url;
    private $selector;
    private $iofIncluded;
    private $keywords;
    private $indexesByExchangeRate;

    /**
     * CurrencyCard constructor.
     * @param array $productProperties
     */
    public function __construct($productProperties)
    {
        $this->url = $productProperties['url'];
        $this->selector = $productProperties['selector'];
        $this->iofIncluded = $productProperties['iofIncluded'];
        $this->keywords = $productProperties['keywords'];
        $this->indexesByExchangeRate = $productProperties['indexesByExchangeRate'];
    }

    /**
     * @return mixed
     */
    public function getIofIncluded()
    {
        return $this->iofIncluded;
    }

    /**
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @return string
     */
    public function getSelector()
    {
        return $this->selector;
    }

    /**
     * @return array
     */
    public function getKeywords()
    {
        return $this->keywords;
    }

    /**
     * @return array
     */
    public function getIndexesByExchangeRate()
    {
        return $this->indexesByExchangeRate;
    }
}