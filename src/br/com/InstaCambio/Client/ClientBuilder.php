<?php

namespace br\com\InstaCambio\Client;

use br\com\InstaCambio\Model\ExchangeOffice;

class ClientBuilder
{

    /**
     * @param ExchangeOffice $exchangeOffice
     * @param string $environment
     * @return InstaCambioClient
     */
    public static function create(ExchangeOffice $exchangeOffice, $environment = 'remote')
    {
        if ($environment === 'local')
            return self::createLocalClient($exchangeOffice);
        else
            return self::createRemoteClient($exchangeOffice);
    }

    /**
     * @param ExchangeOffice $exchangeOffice
     * @return InstaCambioClient
     */
    private static function createLocalClient(ExchangeOffice $exchangeOffice)
    {
        if (self::isInterpreterPage($exchangeOffice))
            return new LocalStubInterpreterClient();

        return new LocalStubStaticClient();
    }

    /**
     * @param ExchangeOffice $exchangeOffice
     * @return mixed
     */
    private static function isInterpreterPage(ExchangeOffice $exchangeOffice)
    {
        return in_array($exchangeOffice->getNickname(), ['bee-cambio', 'europa', 'lhx']);
    }

    /**
     * @param ExchangeOffice $exchangeOffice
     * @return InstaCambioClient
     */
    private static function createRemoteClient(ExchangeOffice $exchangeOffice)
    {
        if (self::isInterpreterPage($exchangeOffice))
            return new RemoteInterpreterClient();

        return new RemoteStaticClient();
    }

}