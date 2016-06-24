<?php

namespace br\com\InstaCambio\Scraper\Strategy;

use br\com\InstaCambio\Model\ExchangeDocument;
use br\com\InstaCambio\Model\Money;

interface ScraperStrategy
{
    /**
     * @param ExchangeDocument $exchangeDocument
     * @return Money[]
     * @throws \ErrorException
     */
    public function scrape(ExchangeDocument $exchangeDocument);
}