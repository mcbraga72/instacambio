<?php

namespace br\com\InstaCambio\Client;

use br\com\InstaCambio\Stub\StubFilePaths;
use br\com\InstaCambio\Stub\StubClient;
use GuzzleHttp\Psr7\Response;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class AbstractLocalStubClient implements InstaCambioClient
{

    public function request($httpMethod, $uri)
    {
        $client = new StubClient();
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
        $pagesPath = StubClient::ROOT_DIR_TESTS_PAGES . DS;
        $url = strval($request->getUri());
        $stubFilePaths = new StubFilePaths();
        $filePaths = $stubFilePaths->filePaths;
        if (key_exists($url, $filePaths) && file_exists($pagesPath . $filePaths[$url])) {
            $response = new Response(200, [], file_get_contents($pagesPath . $filePaths[$url]));
        } else {
            $response = new Response(404, [], '<h1>404 - Page Not Found</h1>');
        }

        if (!(200 <= $response->getStatusCode() && $response->getStatusCode() <= 400))
            throw new RequestException('Page not Found', $response->getStatusCode());

        return $response;
    }
}