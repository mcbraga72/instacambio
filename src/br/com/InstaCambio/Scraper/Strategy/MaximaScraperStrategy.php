<?php

namespace br\com\InstaCambio\Scraper\Strategy;

use br\com\InstaCambio\Model\ExchangeDocument;
use br\com\InstaCambio\Model\ExchangeOffice;
use br\com\InstaCambio\Model\ExchangeOfficeConfig;
use br\com\InstaCambio\Model\Money;
use Symfony\Component\DomCrawler\Crawler;

class MaximaScraperStrategy implements ScraperStrategy
{

    /**
     * @param ExchangeDocument $exchangeDocument
     * @return \br\com\InstaCambio\Model\Money[]
     * @internal param ExchangeOffice $exchangeOffice
     */
    public function scrape(ExchangeDocument $exchangeDocument)
    {
        if ($exchangeDocument->productType() === ExchangeOfficeConfig::FOREIGN_CURRENCY_PRODUCT) {
            $moneys = $this->scrapeForeignCurrencies($exchangeDocument, $exchangeDocument->getExchangeOffice());
        } else {
            $moneys = $this->scrapeCurrencyCards($exchangeDocument, $exchangeDocument->getExchangeOffice());
        }
        return $moneys;
    }

    private function scrapeForeignCurrencies(ExchangeDocument $exchangeDocument, ExchangeOffice $exchangeOffice)
    {
        $moneys = [];
        $product = ExchangeOfficeConfig::getProductByType($exchangeOffice, $exchangeDocument->productType());
        $crawler = $exchangeDocument->getCrawler();
        // remove elements that contains 'CARTÃO' word
        $reducedCrawler = $crawler
            ->filter($product->getSelector())
            ->reduce(function (Crawler $node) {
                if (preg_match('/CARTÃO/i', $node->text()) === 1) {
                    return false;
                }
                return true;
            });
        $keywordsArray = new \ArrayObject($product->getKeywords());
        $reducedCrawler
            ->each(
                function (Crawler $node) use (&$keywordsArray, $product, &$moneys) {
                    $currencyFound = '';
                    foreach ($keywordsArray as $currency => $keywords) {
                        if (preg_match('/' . implode('|', $keywords) . '/', $node->text()) === 1) {
                            $selector = 'div.linha_carga';
                            $node->filter($selector)
                                ->each(
                                    function (Crawler $filteredNode) use ($product, $currency, &$moneys, &$currencyFound) {
                                        if (preg_match('/Taxa de Câmbio/', $filteredNode->text()) === 1) {
                                            $exchangeRate = null;
                                            preg_match_all('/\d{1,5}(?:[.,]\d{3})*(?:[.,]\d{2,5})/', $filteredNode->html(), $exchangeRate);
                                            $exchangeRate = $exchangeRate[0][$product->getIndexesByExchangeRate()[$currency]];
                                            $formattedExchangeRate = floatval(str_replace(',', '.', $exchangeRate));
                                            $moneys[$currency] = Money::create($formattedExchangeRate, $currency);
                                            $currencyFound = $currency;
                                        }
                                    }
                                );
                        }
                    }
                    if ($keywordsArray->offsetExists($currencyFound))
                        $keywordsArray->offsetUnset($currencyFound);
                });
        return $moneys;
    }

    private function scrapeCurrencyCards(ExchangeDocument $exchangeDocument, ExchangeOffice $exchangeOffice)
    {
        $moneys = [];
        $product = ExchangeOfficeConfig::getProductByType($exchangeOffice, $exchangeDocument->productType());
        $crawler = $exchangeDocument->getCrawler();
        $reducedCrawler = $crawler
            ->filter($product->getSelector())
            ->reduce(function (Crawler $node) {
                if (preg_match('/CARTÃO/i', $node->text()) === 0) {
                    return false;
                }
                return true;
            });

        $keywordsArray = new \ArrayObject($product->getKeywords());
        $reducedCrawler
            ->each(
                function (Crawler $node) use (&$keywordsArray, $product, &$moneys) {
                    $currencyFound = '';
                    foreach ($keywordsArray as $currency => $keywords) {
                        if (preg_match('/' . implode('|', $keywords) . '/', $node->text()) === 1) {
                            $selector = 'div.linha_carga';
                            $node->filter($selector)
                                ->each(
                                    function (Crawler $filteredNode) use ($product, $currency, &$moneys, &$currencyFound) {
                                        if (preg_match('/Taxa de Câmbio/', $filteredNode->text()) === 1) {
                                            $exchangeRate = null;
                                            preg_match_all('/\d{1,5}(?:[.,]\d{3})*(?:[.,]\d{2,5})/', $filteredNode->html(), $exchangeRate);
                                            $exchangeRate = $exchangeRate[0][$product->getIndexesByExchangeRate()[$currency]];
                                            $formattedExchangeRate = floatval(str_replace(',', '.', $exchangeRate));
                                            $moneys[$currency] = Money::create($formattedExchangeRate, $currency);
                                            $currencyFound = $currency;
                                        }
                                    }
                                );
                        }
                    }
                    if ($keywordsArray->offsetExists($currencyFound))
                        $keywordsArray->offsetUnset($currencyFound);
                });
        return $moneys;
    }

}