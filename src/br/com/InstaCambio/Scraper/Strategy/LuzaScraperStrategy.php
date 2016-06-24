<?php

namespace br\com\InstaCambio\Scraper\Strategy;

use br\com\InstaCambio\Model\ExchangeDocument;
use br\com\InstaCambio\Model\ExchangeOfficeConfig;
use br\com\InstaCambio\Model\Money;
use Symfony\Component\DomCrawler\Crawler;

class LuzaScraperStrategy implements ScraperStrategy
{

    public function scrape(ExchangeDocument $exchangeDocument)
    {
        $product = ExchangeOfficeConfig::getProductByType($exchangeDocument->getExchangeOffice(), $exchangeDocument->productType());
        $crawler = $exchangeDocument->getCrawler();
        $keywordsArray = new \ArrayObject($product->getKeywords());

        $moneys = [];
        $crawler
            ->filter($product->getSelector())
            ->each(
                function (Crawler $node) use (&$keywordsArray, $product, &$moneys) {
                    $currencyFound = '';
                    $currencyList = explode('|', $node->text());
                    foreach ($currencyList as $item) {
                        foreach ($keywordsArray as $currency => $keywords) {
                            if (preg_match('/' . implode('|', $keywords) . '/', $item) === 1) {
                                $exchangeRate = null;
                                preg_match_all('/\d{1,5}(?:[.,]\d{3})*(?:[.,]\d{2,5})/', $item, $exchangeRate);
                                $exchangeRate = $exchangeRate[0][$product->getIndexesByExchangeRate()[$currency]];
                                $formattedExchangeRate = floatval(str_replace(',', '.', $exchangeRate));
                                $moneys[$currency] = Money::create($formattedExchangeRate, $currency);
                                $currencyFound = $currency;
                                break;
                            }
                        }
                        if ($keywordsArray->offsetExists($currencyFound))
                            $keywordsArray->offsetUnset($currencyFound);
                    }
                });
        return $moneys;
    }
}