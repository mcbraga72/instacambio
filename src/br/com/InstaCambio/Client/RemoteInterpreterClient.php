<?php

namespace br\com\InstaCambio\Client;

use GuzzleHttp\Psr7\Response;
use JonnyW\PhantomJs\Client;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Symfony\Component\DomCrawler\Crawler;

class RemoteInterpreterClient implements InstaCambioClient
{

    /**
     * @todo Implementar código para exceção
     *
     * @param string $httpMethod
     * @param string $uri
     * @return Crawler
     */
    public function request($httpMethod, $uri)
    {
        $client = Client::getInstance();
        $client->getEngine()->setPath(ROOT_DIR . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'bin' . DIRECTORY_SEPARATOR . 'phantomjs');
        $timeout = 15000;
        $request = $client->getMessageFactory()->createRequest($uri, $httpMethod)->setTimeout($timeout);
        $response = $client->getMessageFactory()->createResponse();
        $client->send($request, $response);

        $content = $response->getContent();
        return new Crawler($content);
    }

    /**
     * @param RequestInterface $request
     * @param array $options
     * @return ResponseInterface
     * @throws RequestException
     */
    public function send($request, $options = [])
    {
        $client = Client::getInstance();
        $client->getEngine()->setPath(ROOT_DIR . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'bin' . DIRECTORY_SEPARATOR . 'phantomjs');
        $request = $client->getMessageFactory()->createRequest(strval($request->getUri()), 'GET');
        $response = $client->getMessageFactory()->createResponse();
        $client->send($request, $response);

        if ($response->getStatus() != 408 && $response->getStatus() != 0)
            if (!(200 <= $response->getStatus() && $response->getStatus() <= 400))
                throw new RequestException('Not Found ' . $response->getStatus(), $response->getStatus());

        return new Response($response->getStatus(), $response->getHeaders(), $response->getContent());
    }
}