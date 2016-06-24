<?php

namespace br\com\InstaCambio\Scraper\Strategy;

use br\com\InstaCambio\Model\ExchangeDocument;
use br\com\InstaCambio\Model\ExchangeOfficeConfig;
use br\com\InstaCambio\Model\Money;
use Symfony\Component\DomCrawler\Crawler;

class DibranScraperStrategy implements ScraperStrategy
{

    public function scrape(ExchangeDocument $exchangeDocument)
    {
        $product = ExchangeOfficeConfig::getProductByType($exchangeDocument->getExchangeOffice(), $exchangeDocument->productType());
        $crawler = $exchangeDocument->getCrawler();
        $keywordsArray = new \ArrayObject($product->getKeywords());

        // Scraping dollar
        $crawler
            ->filter($product->getSelector())
            ->each(
                function (Crawler $node) use (&$keywordsArray, $product, &$moneys) {
                    if ($node->attr('id') === 'element-126') {
                        $exchangeRate = null;
                        preg_match_all('/\d{1,5}(?:[.,]\d{3})*(?:[.,]\d{2,5})/', $node->html(), $exchangeRate);
                        $currency = Money::USD(0);
                        $exchangeRate = $exchangeRate[0][$product->getIndexesByExchangeRate()[$currency->getCurrency()]];
                        $formattedExchangeRate = floatval(str_replace(',', '.', $exchangeRate));
                        $moneys[$currency->getCurrency()] = Money::create($formattedExchangeRate, $currency->getCurrency());
                    }
                });
        // Scraping euro
        $crawler
            ->filter($product->getSelector())
            ->each(
                function (Crawler $node) use (&$keywordsArray, $product, &$moneys) {
                    if ($node->attr('id') === 'element-156') {
                        $exchangeRate = null;
                        preg_match_all('/\d{1,5}(?:[.,]\d{3})*(?:[.,]\d{2,5})/', $node->html(), $exchangeRate);
                        $currency = Money::EUR(0);
                        $exchangeRate = $exchangeRate[0][$product->getIndexesByExchangeRate()[$currency->getCurrency()]];
                        $formattedExchangeRate = floatval(str_replace(',', '.', $exchangeRate));
                        $moneys[$currency->getCurrency()] = Money::create($formattedExchangeRate, $currency->getCurrency());
                    }
                });
        return $moneys;
    }
}