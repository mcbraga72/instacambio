<?php

namespace br\com\InstaCambio\Client;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Symfony\Component\DomCrawler\Crawler;

interface InstaCambioClient
{

    /**
     * @param string $httpMethod
     * @param string $url
     * @return Crawler
     */
    public function request($httpMethod, $url);

    /**
     * @param RequestInterface $request
     * @param array $options
     * @return ResponseInterface
     * @throws RequestException
     */
    public function send($request, $options = []);
}