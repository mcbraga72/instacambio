<?php

namespace br\com\InstaCambio\Scraper\Strategy;

use br\com\InstaCambio\Model\ExchangeDocument;
use br\com\InstaCambio\Model\ExchangeOfficeConfig;
use br\com\InstaCambio\Model\Money;
use Symfony\Component\DomCrawler\Crawler;

class ThalerScraperStrategy implements ScraperStrategy
{

    public function scrape(ExchangeDocument $exchangeDocument)
    {
        $product = ExchangeOfficeConfig::getProductByType($exchangeDocument->getExchangeOffice(), $exchangeDocument->productType());
        $crawler = $exchangeDocument->getCrawler();
        $keywordsArray = new \ArrayObject($product->getKeywords());

        $filteredNodes = $crawler->filter($product->getSelector());
        $moneys = [];
        if (count($product->getKeywords()) === $filteredNodes->count()) {
            $filteredNodes->each(
                function (Crawler $node, $position) use (&$keywordsArray, $product, &$moneys) {
                    $currencies = array_keys($product->getKeywords());
                    /** @noinspection PhpUnusedLocalVariableInspection */
                    foreach ($currencies as $currencyCode) {
                        $money = Money::create(0, $currencies[$position]);
                        $exchangeRate = null;
                        preg_match_all('/\d{1,5}(?:[.,]\d{3})*(?:[.,]\d{2,5})/', $node->html(), $exchangeRate);
                        $exchangeRate = $exchangeRate[0][$product->getIndexesByExchangeRate()[$money->getCurrency()]];
                        $formattedExchangeRate = floatval(str_replace(',', '.', $exchangeRate));
                        $moneys[$money->getCurrency()] = Money::create($formattedExchangeRate, $money->getCurrency());
                        break;
                    }
                });
        }

        return $moneys;
    }
}