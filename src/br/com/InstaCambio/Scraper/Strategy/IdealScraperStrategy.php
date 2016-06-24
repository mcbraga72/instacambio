<?php

namespace br\com\InstaCambio\Scraper\Strategy;

use br\com\InstaCambio\Model\ExchangeDocument;
use br\com\InstaCambio\Model\ExchangeOffice;
use br\com\InstaCambio\Model\ExchangeOfficeConfig;
use br\com\InstaCambio\Model\Money;
use Symfony\Component\DomCrawler\Crawler;

class IdealScraperStrategy implements ScraperStrategy
{
    public function scrape(ExchangeDocument $exchangeDocument)
    {
        if ($exchangeDocument->productType() === ExchangeOfficeConfig::FOREIGN_CURRENCY_PRODUCT) {
            $moneys = $this->scrapeForeignCurrency($exchangeDocument, $exchangeDocument->getExchangeOffice());
        } else {
            $moneys = $this->scrapeCurrencyCard($exchangeDocument, $exchangeDocument->getExchangeOffice());
        }
        return $moneys;
    }

    private function scrapeForeignCurrency(ExchangeDocument $exchangeDocument, ExchangeOffice $exchangeOffice)
    {
        $moneys = [];
        $product = ExchangeOfficeConfig::getProductByType($exchangeOffice, $exchangeDocument->productType());
        $crawler = $exchangeDocument->getCrawler();

        $keywordsArray = new \ArrayObject($product->getKeywords());
        $crawler
            ->filter($product->getSelector())
            ->first()
            ->filter('td')
            ->each(
                function (Crawler $node) use (&$keywordsArray, $product, &$moneys) {
                    $currencyFound = '';
                    foreach ($keywordsArray as $currency => $keywords) {
                        if (preg_match('/' . implode('|', $keywords) . '/', $node->text()) === 1) {
                            $exchangeRate = null;
                            preg_match_all(
                                '/\d{1,5}(?:[.,]\d{3})*(?:[.,]\d{2,5})/',
                                $node->nextAll()->eq(1)->html(),
                                $exchangeRate
                            );
                            if (empty($exchangeRate[0][$product->getIndexesByExchangeRate()[$currency]]))
                                trigger_error("Undefined offset: {$product->getIndexesByExchangeRate()[$currency]} - currency: {$currency}");

                            $exchangeRate = $exchangeRate[0][$product->getIndexesByExchangeRate()[$currency]];
                            $formattedExchangeRate = floatval(str_replace(',', '.', $exchangeRate));
                            $moneys[$currency] = Money::create($formattedExchangeRate, $currency);
                            $currencyFound = $currency;
                            break;
                        }
                    }
                    if ($keywordsArray->offsetExists($currencyFound))
                        $keywordsArray->offsetUnset($currencyFound);
                });
        return $moneys;
    }

    private function scrapeCurrencyCard(ExchangeDocument $exchangeDocument, ExchangeOffice $exchangeOffice)
    {
        $moneys = [];
        $product = ExchangeOfficeConfig::getProductByType($exchangeOffice, $exchangeDocument->productType());
        $crawler = $exchangeDocument->getCrawler();

        $keywordsArray = new \ArrayObject($product->getKeywords());
        $crawler
            ->filter($product->getSelector())
            ->eq(1)
            ->filter('td')
            ->each(
                function (Crawler $node) use (&$keywordsArray, $product, &$moneys) {
                    $currencyFound = '';
                    foreach ($keywordsArray as $currency => $keywords) {
                        if (preg_match('/' . implode('|', $keywords) . '/', $node->text()) === 1) {
                            $exchangeRate = null;
                            preg_match_all(
                                '/\d{1,5}(?:[.,]\d{3})*(?:[.,]\d{2,5})/',
                                $node->nextAll()->eq(1)->html(),
                                $exchangeRate
                            );
                            if (empty($exchangeRate[0][$product->getIndexesByExchangeRate()[$currency]]))
                                trigger_error("Undefined offset: {$product->getIndexesByExchangeRate()[$currency]} - currency: {$currency}");

                            $exchangeRate = $exchangeRate[0][$product->getIndexesByExchangeRate()[$currency]];
                            $formattedExchangeRate = floatval(str_replace(',', '.', $exchangeRate));
                            $moneys[$currency] = Money::create($formattedExchangeRate, $currency);
                            $currencyFound = $currency;
                            break;
                        }
                    }
                    if ($keywordsArray->offsetExists($currencyFound))
                        $keywordsArray->offsetUnset($currencyFound);
                });
        return $moneys;
    }
}