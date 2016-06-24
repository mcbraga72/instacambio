<?php

namespace br\com\InstaCambio\Scraper\Strategy;

use br\com\InstaCambio\Model\ExchangeDocument;
use br\com\InstaCambio\Model\ExchangeOfficeConfig;
use br\com\InstaCambio\Model\Money;
use Symfony\Component\DomCrawler\Crawler;

class TurvicamScraperStrategy implements ScraperStrategy
{

    /**
     * @param ExchangeDocument $exchangeDocument
     * @return \br\com\InstaCambio\Model\Money[]
     * @internal param ExchangeOffice $exchangeOffice
     */
    public function scrape(ExchangeDocument $exchangeDocument)
    {
        if ($exchangeDocument->productType() === ExchangeOfficeConfig::FOREIGN_CURRENCY_PRODUCT) {
            $moneys = $this->scrapeForeignCurrencies($exchangeDocument);
        } else {
            $moneys = $this->scrapeCurrencyCards($exchangeDocument);
        }
        return $moneys;
    }

    private function scrapeForeignCurrencies(ExchangeDocument $exchangeDocument)
    {
        $product = ExchangeOfficeConfig::getProductByType($exchangeDocument->getExchangeOffice(), $exchangeDocument->productType());
        $crawler = $exchangeDocument->getCrawler();
        $keywordsArray = new \ArrayObject($product->getKeywords());
        $crawler
            ->filter($product->getSelector())
            ->each(
                function (Crawler $node) use (&$keywordsArray, $product, &$moneys) {
                    $currencyFound = '';
                    foreach ($keywordsArray as $currency => $keywords) {
                        if (preg_match('/' . implode('|', $keywords) . '/', $node->text()) === 1) {
                            $exchangeRate = null;
                            preg_match_all('/\d{1,5}(?:[.,]\d{3})*(?:[.,]\d{2,5})/', $node->html(), $exchangeRate);
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

    private function scrapeCurrencyCards(ExchangeDocument $exchangeDocument)
    {
        $product = ExchangeOfficeConfig::getProductByType($exchangeDocument->getExchangeOffice(), $exchangeDocument->productType());
        $crawler = $exchangeDocument->getCrawler();
        $keywordsArray = new \ArrayObject($product->getKeywords());
        $filterCrawler = $crawler->filter($product->getSelector());
        $filterCrawler->each(
            function (Crawler $node) use (&$keywordsArray, $product, &$moneys) {
                foreach ($keywordsArray as $currency => $keywords) {
                    if (preg_match_all('/' . implode('|', $keywords) . '/', $node->text()) === 1) {
                        $exchangeRate = null;
                        preg_match_all('/\d{1,5}(?:[.,]\d{3})*(?:[.,]\d{2,5})/', $node->html(), $exchangeRate);
                        $exchangeRate = $exchangeRate[0][$product->getIndexesByExchangeRate()[$currency]];
                        $formattedExchangeRate = floatval(str_replace(',', '.', $exchangeRate));
                        $moneys[$currency] = Money::create($formattedExchangeRate, $currency);
                        break;
                    }
                }
            });
        return $moneys;
    }

}