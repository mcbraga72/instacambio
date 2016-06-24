<?php

namespace br\com\InstaCambio\Shell\Task\Scrape;

use br\com\InstaCambio\Model\ExchangeOffice;
use br\com\InstaCambio\Model\ExchangeOfficeConfig;
use br\com\InstaCambio\Model\ExchangeScrapeResult;
use br\com\InstaCambio\Model\Money;

/**
 * @property ScrapeWorker $worker
 */
class ScrapeWork extends \Collectable
{
    /**
     *
     * @var ExchangeScrapeResult
     */
    public $exchangeResults;
    protected $garbage = false;
    /**
     *
     * @var ExchangeOffice
     */
    private $exchangeOffice;

    public function __construct(ExchangeOffice $exchangeOffice)
    {
        $this->exchangeOffice = $exchangeOffice;
    }

    public function run()
    {
        $moneys = [];
        $moneys['foreignCurrency'] = $this->scrapeExchangeRateForForeignCurrency();
        $moneys['currencyCard'] = $this->scrapeExchangeRateForCurrencyCard();
        $this->exchangeResults = new ExchangeScrapeResult($this->exchangeOffice, $moneys);

        $this->setGarbage();
    }

    /**
     * @return Money[]
     */
    private function scrapeExchangeRateForForeignCurrency()
    {
        $exchangeOfficeProduct = ExchangeOfficeConfig::getProductByType($this->exchangeOffice, ExchangeOfficeConfig::FOREIGN_CURRENCY_PRODUCT);
        if (!$exchangeOfficeProduct)
            return false;

        $exchangeDocumentForeignCurrency = $this->worker->exchangeClient->generateDocument($this->exchangeOffice, ExchangeOfficeConfig::FOREIGN_CURRENCY_PRODUCT);
        return $this->worker->exchangeScraper->scrapeExchangeRates($exchangeDocumentForeignCurrency);
    }

    /**
     * @return Money[]
     */
    private function scrapeExchangeRateForCurrencyCard()
    {
        $exchangeOfficeProduct = ExchangeOfficeConfig::getProductByType($this->exchangeOffice, ExchangeOfficeConfig::CURRENCY_CARD_PRODUCT);
        if (!$exchangeOfficeProduct)
            return false;

        $exchangeDocumentCurrencyCard = $this->worker->exchangeClient->generateDocument($this->exchangeOffice, ExchangeOfficeConfig::CURRENCY_CARD_PRODUCT);
        return $this->worker->exchangeScraper->scrapeExchangeRates($exchangeDocumentCurrencyCard);
    }

    public function isGarbage()
    {
        return $this->garbage;
    }

    public function setGarbage()
    {
        $this->garbage = true;
    }

}
