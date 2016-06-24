<?php

namespace br\com\InstaCambio\Model;

use Symfony\Component\DomCrawler\Crawler;

class ExchangeDocument
{

    private $crawler;
    private $productType;
    private $exchangeOffice;

    public function __construct(Crawler $crawler, $productType, ExchangeOffice $exchangeOffice)
    {
        $this->crawler = $crawler;
        $this->productType = $productType;
        $this->exchangeOffice = $exchangeOffice;
    }

    public function productType()
    {
        return $this->productType;
    }

    public function getCrawler()
    {
        return $this->crawler;
    }

    public function getExchangeOffice()
    {
        return $this->exchangeOffice;
    }
}
