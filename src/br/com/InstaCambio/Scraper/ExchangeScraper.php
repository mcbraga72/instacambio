<?php

namespace br\com\InstaCambio\Scraper;

use br\com\InstaCambio\Model\ExchangeDocument;
use br\com\InstaCambio\Model\Money;
use br\com\InstaCambio\Scraper\Strategy\ScraperStrategyBuilder;

class ExchangeScraper
{
    /**
     * @param ExchangeDocument $exchangeDocument
     * @return Money[]
     */
    public function scrapeExchangeRates(ExchangeDocument $exchangeDocument)
    {
        $exchangeOffice = $exchangeDocument->getExchangeOffice();
        $scraperStrategy = ScraperStrategyBuilder::create($exchangeOffice);
        $this->enableErrorTranslationForException();
        $moneys = $scraperStrategy->scrape($exchangeDocument);
        $this->disableErrorTranslationForException();
        return $moneys;
    }

    private function enableErrorTranslationForException()
    {
        set_error_handler(function ($severity, $message, $file, $line) {
            if (!(error_reporting() & $severity)) {
                // This error code is not included in error_reporting
                return;
            }
            throw new \ErrorException($message, 0, $severity, $file, $line);
        });
    }

    private function disableErrorTranslationForException()
    {
        restore_error_handler();
    }
}
