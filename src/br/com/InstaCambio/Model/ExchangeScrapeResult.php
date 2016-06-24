<?php

namespace br\com\InstaCambio\Model;

class ExchangeScrapeResult
{

    /**
     * @var ExchangeOffice
     */
    private $exchangeOffice;

    /**
     * @var Money[]
     */
    private $moneys;

    /**
     * @param ExchangeOffice $exchangeOffice
     * @param Money[] $moneys
     */
    public function __construct(ExchangeOffice $exchangeOffice, array $moneys)
    {
        $this->exchangeOffice = $exchangeOffice;
        $this->moneys = $moneys;
    }

    function getExchangeOffice()
    {
        return $this->exchangeOffice;
    }

    /**
     * @return Money[]
     */
    public function getMoneys()
    {
        return $this->moneys;
    }


}
