<?php

namespace br\com\InstaCambio\Model;

class ExchangeScrapeResultTest extends \PHPUnit_Framework_TestCase
{

    public function testExchangeResultInstantiated()
    {
        $exchangeResult = new ExchangeScrapeResult(ExchangeOfficeConfig::get('prime-cash'), ['USD' => Money::USD(4.00)]);

        $exchangeOffice = $exchangeResult->getExchangeOffice();
        $this->assertEquals('Prime Cash', $exchangeOffice->getName());
        $this->assertEquals('prime-cash', $exchangeOffice->getNickname());

        $moneys = $exchangeResult->getMoneys();
        $this->assertEquals(4.00, $moneys['USD']->getAmount());
        $this->assertEquals('USD', $moneys['USD']->getCurrency());
    }

}
