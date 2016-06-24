<?php

namespace br\com\InstaCambio\Client;

use br\com\InstaCambio\Model\ExchangeDocument;
use br\com\InstaCambio\Model\ExchangeOffice;
use br\com\InstaCambio\Model\ExchangeOfficeConfig;
use br\com\InstaCambio\Model\ExchangeOfficeProduct;
use GuzzleHttp\Psr7\Request;
use Psr\Http\Message\ResponseInterface;
use Symfony\Component\DomCrawler\Crawler;

class ExchangeClient
{
    /**
     * @var string
     */
    private $environment;

    public function __construct($environment = 'remote')
    {
        $this->environment = $environment;
    }

    public function generateDocument(ExchangeOffice $exchangeOffice, $productType)
    {
        $client = ClientBuilder::create($exchangeOffice, $this->environment);
        $product = ExchangeOfficeConfig::getProductByType($exchangeOffice, $productType);
        $crawler = $client->request('get', $product->getUrl());
        if ($exchangeOffice->isDecode()) {
            $htmlContentDecoded = utf8_decode($crawler->html());
            $crawler = new Crawler(null, $product->getUrl());
            $crawler->addHtmlContent($htmlContentDecoded);
        }
        return new ExchangeDocument($crawler, $productType, $exchangeOffice);
    }

    /**
     * @param ExchangeOffice $exchangeOffice
     * @param ExchangeOfficeProduct $exchangeOfficeProduct
     * @return ResponseInterface
     * @throws ExchangeClientException
     */
    public function send(ExchangeOffice $exchangeOffice, ExchangeOfficeProduct $exchangeOfficeProduct)
    {
        try {
            $client = ClientBuilder::create($exchangeOffice, $this->environment);
            $request = new Request('get', $exchangeOfficeProduct->getUrl());
            $response = $client->send($request);
            return $response;
        } catch (RequestException $e) {
            $message = "exchange office: {$exchangeOffice->getNickname()} " . $e->getMessage();
            throw new ExchangeClientException($message, $e->getCode(), $e);
        }
    }

}
