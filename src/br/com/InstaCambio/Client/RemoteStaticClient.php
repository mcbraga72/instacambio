<?php

namespace br\com\InstaCambio\Client;

use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\Exception\TransferException;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Symfony\Component\DomCrawler\Crawler;

class RemoteStaticClient implements InstaCambioClient
{
    /**
     * @param string $httpMethod
     * @param string $uri
     * @return Crawler
     * @throws \Exception
     * @deprecated Method of package require refactoring
     */
    public function request($httpMethod, $uri)
    {
        throw new \Exception('Method not implemented.');
        return new Crawler();
    }

    /**
     * @param RequestInterface $request
     * @param array $options
     * @return ResponseInterface
     * @throws RequestException
     */
    public function send($request, $options = [])
    {

        try {
            $client = new GuzzleClient();
            $response = $client->send($request, ['timeout' => 29]);
            return $response;
        } catch (TransferException $e) {
            throw new RequestException($e->getMessage(), $e->getCode(), $e);
        }
    }
}