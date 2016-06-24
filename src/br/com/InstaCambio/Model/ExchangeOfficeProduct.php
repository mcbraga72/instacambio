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
     * @param array $currencyCardProperties
     */
    public function __construct($currencyCardProperties)
    {
        $this->url = $currencyCardProperties['url'];
        $this->selector = $currencyCardProperties['selector'];
        $this->iofIncluded = key_exists('iofIncluded', $currencyCardProperties) ? $currencyCardProperties['iofIncluded'] : true;
        $this->keywords = $currencyCardProperties['keywords'];
        $this->indexesByExchangeRate = $currencyCardProperties['indexesByExchangeRate'];
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