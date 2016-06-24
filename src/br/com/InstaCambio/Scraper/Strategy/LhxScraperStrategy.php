<?php

namespace br\com\InstaCambio\Scraper\Strategy;

use br\com\InstaCambio\Model\ExchangeDocument;
use br\com\InstaCambio\Model\ExchangeOfficeConfig;
use br\com\InstaCambio\Model\Money;
use Symfony\Component\DomCrawler\Crawler;

class LhxScraperStrategy implements ScraperStrategy
{

    public function scrape(ExchangeDocument $exchangeDocument)
    {
        $exchangeOfficeProduct = ExchangeOfficeConfig::getProductByType($exchangeDocument->getExchangeOffice(), $exchangeDocument->productType());
        $crawler = $exchangeDocument->getCrawler();
        $keywordsArray = new \ArrayObject($exchangeOfficeProduct->getKeywords());
        $moneys = [];
        $crawler
            ->filter($exchangeOfficeProduct->getSelector())
            ->each(
                function (Crawler $node) use (&$keywordsArray, $exchangeOfficeProduct, &$moneys) {
                    $currencyFound = '';
                    $currencyList = explode('<br>', $node->html());
                    $currencyList = implode('//', $currencyList);
                    $currencyList = explode('//', $currencyList);
                    foreach ($currencyList as $item) {
                        foreach ($keywordsArray as $currency => $keywords) {
                            if (preg_match('/' . implode('|', $keywords) . '/', $item) === 1) {
                                $exchangeRate = null;
                                preg_match_all('/\d{1,5}(?:[.,]\d{3})*(?:[.,]\d{2,5})/', $item, $exchangeRate);
                                $exchangeRate = $exchangeRate[0][$exchangeOfficeProduct->getIndexesByExchangeRate()[$currency]];
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