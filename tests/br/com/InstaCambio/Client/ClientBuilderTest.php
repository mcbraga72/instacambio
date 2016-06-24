<?php

namespace br\com\InstaCambio\Client;

use br\com\InstaCambio\Model\ExchangeOfficeConfig;

class ClientBuilderTest extends \PHPUnit_Framework_TestCase
{
    public function testCheckInstanceOfClientForEachExchangeOfficeGiven()
    {
        // Remote
        $exchangeOffice = ExchangeOfficeConfig::get('prime-cash');
        $this->assertInstanceOf(RemoteStaticClient::class, ClientBuilder::create($exchangeOffice, 'remote'));
        $this->assertInstanceOf(InstaCambioClient::class, ClientBuilder::create($exchangeOffice, 'remote'));
        $exchangeOffice = ExchangeOfficeConfig::get('fast-money');
        $this->assertInstanceOf(RemoteStaticClient::class, ClientBuilder::create($exchangeOffice, 'remote'));
        $exchangeOffice = ExchangeOfficeConfig::get('cambio-store');
        $this->assertInstanceOf(RemoteStaticClient::class, ClientBuilder::create($exchangeOffice, 'remote'));

        $exchangeOffice = ExchangeOfficeConfig::get('bee-cambio');
        $this->assertInstanceOf(RemoteInterpreterClient::class, ClientBuilder::create($exchangeOffice, 'remote'));
        $this->assertInstanceOf(InstaCambioClient::class, ClientBuilder::create($exchangeOffice, 'remote'));
        $exchangeOffice = ExchangeOfficeConfig::get('europa');
        $this->assertInstanceOf(RemoteInterpreterClient::class, ClientBuilder::create($exchangeOffice, 'remote'));

        // Local
        $exchangeOffice = ExchangeOfficeConfig::get('prime-cash');
        $this->assertInstanceOf(LocalStubStaticClient::class, ClientBuilder::create($exchangeOffice, 'local'));
        $this->assertInstanceOf(InstaCambioClient::class, ClientBuilder::create($exchangeOffice, 'local'));
        $exchangeOffice = ExchangeOfficeConfig::get('fast-money');
        $this->assertInstanceOf(LocalStubStaticClient::class, ClientBuilder::create($exchangeOffice, 'local'));
        $exchangeOffice = ExchangeOfficeConfig::get('cambio-store');
        $this->assertInstanceOf(LocalStubStaticClient::class, ClientBuilder::create($exchangeOffice, 'local'));

        $exchangeOffice = ExchangeOfficeConfig::get('bee-cambio');
        $this->assertInstanceOf(LocalStubInterpreterClient::class, ClientBuilder::create($exchangeOffice, 'local'));
        $this->assertInstanceOf(InstaCambioClient::class, ClientBuilder::create($exchangeOffice, 'local'));
        $exchangeOffice = ExchangeOfficeConfig::get('europa');
        $this->assertInstanceOf(LocalStubInterpreterClient::class, ClientBuilder::create($exchangeOffice, 'local'));
    }

}
