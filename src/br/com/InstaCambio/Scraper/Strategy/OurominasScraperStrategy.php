<?php

namespace br\com\InstaCambio\Scraper\Strategy;

use br\com\InstaCambio\Model\ExchangeDocument;
use br\com\InstaCambio\Model\ExchangeOffice;
use br\com\InstaCambio\Model\ExchangeOfficeConfig;
use br\com\InstaCambio\Model\Money;
use Symfony\Component\DomCrawler\Crawler;

class OurominasScraperStrategy implements ScraperStrategy
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
        $moneys = [];
        $crawler->filter($product->getSelector())
            ->each(
                function (Crawler $node) use (&$keywordsArray, $product, &$moneys) {
                    $currencyFound = '';
                    $currencyList = array_filter(array_map('trim', explode("\n", $node->text())));
                    $currencyList = array_filter($currencyList, function ($value) {
                        if (preg_match('/Câmbio Card/i', $value) === 1)
                            return false;
                        return true;
                    });
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

    private function scrapeCurrencyCard(ExchangeDocument $exchangeDocument, ExchangeOffice $exchangeOffice)
    {
        $product = ExchangeOfficeConfig::getProductByType($exchangeOffice, $exchangeDocument->productType());
        $crawler = $exchangeDocument->getCrawler();
        $keywordsArray = new \ArrayObject($product->getKeywords());
        $moneys = [];
        $crawler->filter($product->getSelector())
            ->each(
                function (Crawler $node) use (&$keywordsArray, $product, &$moneys) {
                    $currencyFound = '';
                    $currencyList = array_filter(array_map('trim', explode("\n", $node->text())));
                    $currencyList = array_filter($currencyList, function ($value) {
                        if (preg_match('/Câmbio Card/i', $value) === 1)
                            return true;
                        return false;
                    });
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