<?php

namespace br\com\InstaCambio\Scraper\Strategy;

use br\com\InstaCambio\Model\ExchangeDocument;
use br\com\InstaCambio\Model\ExchangeOffice;
use br\com\InstaCambio\Model\ExchangeOfficeConfig;
use br\com\InstaCambio\Model\Money;
use Symfony\Component\DomCrawler\Crawler;

class NavegantesScraperStrategy implements ScraperStrategy
{

    public function scrape(ExchangeDocument $exchangeDocument)
    {
        if ($exchangeDocument->productType() === ExchangeOfficeConfig::FOREIGN_CURRENCY_PRODUCT) {
            return $this->scrapeForeignCurrency($exchangeDocument, $exchangeDocument->getExchangeOffice());
        } else {
            return $this->scrapeCurrencyCard($exchangeDocument, $exchangeDocument->getExchangeOffice());
        }
    }

    private function scrapeForeignCurrency(ExchangeDocument $exchangeDocument, ExchangeOffice $exchangeOffice)
    {
        $product = ExchangeOfficeConfig::getProductByType($exchangeOffice, $exchangeDocument->productType());
        $crawler = $exchangeDocument->getCrawler();
        $keywordsArray = new \ArrayObject($product->getKeywords());

        $positions = new \ArrayObject();
        $crawler
            ->filter($product->getSelector())
            ->first()
            ->filter('td')
            ->each(function (Crawler $node, $position) use (&$keywordsArray, &$positions) {
                if (in_array($node->text(), ['Moeda', 'Dólar Comecial']))
                    return true;

                $currencyFound = '';
                foreach ($keywordsArray as $currency => $keywords) {
                    if (preg_match('/' . implode('|', $keywords) . '/', $node->text()) === 1) {
                        $positions->offsetSet($currency, $position);
                        $currencyFound = $currency;
                        break;
                    }
                }
                if ($keywordsArray->offsetExists($currencyFound))
                    $keywordsArray->offsetUnset($currencyFound);
                return true;
            });
        $crawler
            ->filter($product->getSelector())
            ->eq(2)
            ->each(function (Crawler $node) use (&$positions, &$moneys, $product) {
                foreach ($positions as $currency => $position) {
                    $exchangeRate = null;
                    preg_match_all('/\d{1,5}(?:[.,]\d{3})*(?:[.,]\d{2,5})/', $node->filter('td')->eq($position)->text(), $exchangeRate);
                    $exchangeRate = $exchangeRate[0][$product->getIndexesByExchangeRate()[$currency]];
                    $formattedExchangeRate = floatval(str_replace(',', '.', $exchangeRate));
                    $moneys[$currency] = Money::create($formattedExchangeRate, $currency);
                }
            });
        return $moneys;
    }

    private function scrapeCurrencyCard(ExchangeDocument $exchangeDocument, ExchangeOffice $exchangeOffice)
    {
        $product = ExchangeOfficeConfig::getProductByType($exchangeOffice, $exchangeDocument->productType());
        $crawler = $exchangeDocument->getCrawler();
        $keywordsArray = new \ArrayObject($product->getKeywords());

        $positions = new \ArrayObject();
        $crawler
            ->filter($product->getSelector())
            ->first()
            ->filter('td')
            ->each(function (Crawler $node, $position) use (&$keywordsArray, &$positions) {
                if (in_array($node->text(), ['Moeda', 'Dólar Comecial']))
                    return true;

                $currencyFound = '';
                foreach ($keywordsArray as $currency => $keywords) {
                    if (preg_match('/' . implode('|', $keywords) . '/', $node->text()) === 1) {
                        $positions->offsetSet($currency, $position);
                        $currencyFound = $currency;
                        break;
                    }
                }
                if ($keywordsArray->offsetExists($currencyFound))
                    $keywordsArray->offsetUnset($currencyFound);
                
                return true;
            });
        $crawler
            ->filter($product->getSelector())
            ->eq(3)
            ->each(function (Crawler $node) use (&$positions, &$moneys, $product) {
                foreach ($positions as $currency => $position) {
                    $exchangeRate = null;
                    preg_match_all('/\d{1,5}(?:[.,]\d{3})*(?:[.,]\d{2,5})/', $node->filter('td')->eq($position)->text(), $exchangeRate);
                    $exchangeRate = $exchangeRate[0][$product->getIndexesByExchangeRate()[$currency]];
                    $formattedExchangeRate = floatval(str_replace(',', '.', $exchangeRate));
                    $moneys[$currency] = Money::create($formattedExchangeRate, $currency);
                }
            });
        return $moneys;
    }
}