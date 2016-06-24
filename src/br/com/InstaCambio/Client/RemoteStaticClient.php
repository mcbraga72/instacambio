<?php

namespace br\com\InstaCambio\Client;

use Goutte\Client;
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
     */
    public function request($httpMethod, $uri)
    {
        $client = new Client();
        return $client->request($httpMethod, $uri);
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