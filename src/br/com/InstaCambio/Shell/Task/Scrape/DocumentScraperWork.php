<?php

namespace br\com\InstaCambio\Shell\Task\Scrape;

use br\com\InstaCambio\Client\SlackClient;
use br\com\InstaCambio\Helper\LogWrapper;
use br\com\InstaCambio\Model\ExchangeDocument;
use br\com\InstaCambio\Model\ExchangeOfficeConfig;
use br\com\InstaCambio\Model\ExchangeScrapeResult;
use br\com\InstaCambio\Scraper\ExchangeScraper;
use Maknz\Slack\Client;
use Monolog\Logger;

class DocumentScraperWork
{
    /**
     * @var LogWrapper
     */
    public $logWrapper;
    /**
     *
     * @var ExchangeScrapeResult
     */
    public $exchangeResults;
    /**
     * @var bool
     */
    protected $garbage = false;
    private $exchangeScraper;
    /**
     * @var ExchangeDocument
     */
    private $exchangeDocuments;

    /**
     * DocumentScraperWork constructor.
     * @param ExchangeDocument[] $exchangeDocuments
     */
    public function __construct(array $exchangeDocuments)
    {
        $this->exchangeDocuments = $exchangeDocuments;
        $this->exchangeScraper = new ExchangeScraper();
    }

    public function run()
    {
        $moneys = [];
        $exchangeOffice = null;
        $logWrapper = new LogWrapper();
        foreach ($this->exchangeDocuments as $index => $exchangeDocument) {
            if (ExchangeOfficeConfig::FOREIGN_CURRENCY_PRODUCT === $exchangeDocument->productType()) {
                try {
                    $moneys['foreignCurrency'] = $this->exchangeScraper->scrapeExchangeRates($exchangeDocument);
                } catch (\ErrorException $e) {
                    $logWrapper->addLog("{$e->getMessage()} in {$e->getFile()}:{$e->getLine()}", Logger::ERROR, [
                        'nickname' => $exchangeDocument->getExchangeOffice()->getNickname(),
                        'productType' => $exchangeDocument->productType(),
                    ]);
                    $message = $e->getMessage() . ' in ' . $e->getFile() . ': ' . $e->getLine() . '/ Exchange Office: ' . $exchangeDocument->getExchangeOffice()->getNickname() . ' - Product Type: ' . $exchangeDocument->productType();
                    SlackClient::slack($message, "crawler");
                }
            } else if (ExchangeOfficeConfig::CURRENCY_CARD_PRODUCT === $exchangeDocument->productType()) {
                try {
                    $moneys['currencyCard'] = $this->exchangeScraper->scrapeExchangeRates($exchangeDocument);
                } catch (\ErrorException $e) {
                    $logWrapper->addLog("{$e->getMessage()} in {$e->getFile()}:{$e->getLine()}", Logger::ERROR, [
                        'nickname' => $exchangeDocument->getExchangeOffice()->getNickname(),
                        'productType' => $exchangeDocument->productType(),
                    ]);
                    $message = $e->getMessage() . ' in ' . $e->getFile() . ': ' . $e->getLine() . '/ Exchange Office: ' . $exchangeDocument->getExchangeOffice()->getNickname() . ' - Product Type: ' . $exchangeDocument->productType();
                    SlackClient::slack($message, "crawler");
                }
            }
            $exchangeOffice = $exchangeDocument->getExchangeOffice();
        }
        $this->exchangeResults = new ExchangeScrapeResult($exchangeOffice, $moneys);
        $this->logWrapper = $logWrapper;
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