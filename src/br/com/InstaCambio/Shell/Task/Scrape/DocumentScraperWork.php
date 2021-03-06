<?php

namespace br\com\InstaCambio\Shell\Task\Scrape;

use br\com\InstaCambio\Client\SlackClient;
use br\com\InstaCambio\Helper\LogWrapper;
use br\com\InstaCambio\Model\ExchangeDocument;
use br\com\InstaCambio\Model\ExchangeOfficeConfig;
use br\com\InstaCambio\Model\ExchangeScrapeResult;
use br\com\InstaCambio\Scraper\ExchangeScraper;
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
                    $color = '#4CAF50';
                    $message = 'Scraper da casa de câmbio ' . $exchangeDocument->getExchangeOffice()->getName() . ' para papel-moeda, realizado com sucesso!';
                    SlackClient::slack($message, $color, "crawler");
                } catch (\ErrorException $e) {
                    $logWrapper->addLog("{$e->getMessage()} in {$e->getFile()}:{$e->getLine()}", Logger::ERROR, [
                        'nickname' => $exchangeDocument->getExchangeOffice()->getNickname(),
                        'productType' => $exchangeDocument->productType(),
                    ]);
                    $message = $e->getMessage() . ' in ' . $e->getFile() . ': ' . $e->getLine() . '/ Casa de câmbio: ' . $exchangeDocument->getExchangeOffice()->getNickname() . ' - Produto: ' . $exchangeDocument->productType();
                    $color = '#FF0000';
                    SlackClient::slack($message, $color, "crawler");
                }
            } else if (ExchangeOfficeConfig::CURRENCY_CARD_PRODUCT === $exchangeDocument->productType()) {
                try {
                    $moneys['currencyCard'] = $this->exchangeScraper->scrapeExchangeRates($exchangeDocument);
                    $color = '#4CAF50';
                    $message = 'Scraper da casa de câmbio ' . $exchangeDocument->getExchangeOffice()->getName() . ' para cartão pré-pago, realizado com sucesso!';
                    SlackClient::slack($message, $color, "crawler");
                } catch (\ErrorException $e) {
                    $logWrapper->addLog("{$e->getMessage()} in {$e->getFile()}:{$e->getLine()}", Logger::ERROR, [
                        'nickname' => $exchangeDocument->getExchangeOffice()->getNickname(),
                        'productType' => $exchangeDocument->productType(),
                    ]);
                    $message = $e->getMessage() . ' in ' . $e->getFile() . ': ' . $e->getLine() . '/ Casa de câmbio: ' . $exchangeDocument->getExchangeOffice()->getNickname() . ' - Produto: ' . $exchangeDocument->productType();
                    $color = '#FF0000';
                    SlackClient::slack($message, $color, "crawler");
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