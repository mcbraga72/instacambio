<?php

namespace br\com\InstaCambio\Model;

class MoneyTest extends \PHPUnit_Framework_TestCase
{
    public function testUSDMoney()
    {
        $money = Money::USD(4.30);
        $this->assertEquals(4.30, $money->getAmount());
        $this->assertEquals('USD', $money->getCurrency());
    }

    public function testEURMoney()
    {
        $money = Money::EUR(4.70);
        $this->assertEquals(4.70, $money->getAmount());
        $this->assertEquals('EUR', $money->getCurrency());
    }

    public function testGBPMoney()
    {
        $money = Money::GBP(6.00);
        $this->assertEquals(6.00, $money->getAmount());
        $this->assertEquals('GBP', $money->getCurrency());
    }

    public function testCADMoney()
    {
        $money = Money::CAD(3.00);
        $this->assertEquals(3.00, $money->getAmount());
        $this->assertEquals('CAD', $money->getCurrency());
    }

    public function testAUDMoney()
    {
        $amount = 3.01;
        $money = Money::AUD($amount);
        $this->assertEquals(3.01, $money->getAmount());
        $this->assertEquals('AUD', $money->getCurrency());
    }

    public function testARSMoney()
    {
        $amount = 0.32;
        $money = Money::ARS($amount);
        $this->assertEquals(0.32, $money->getAmount());
        $this->assertEquals('ARS', $money->getCurrency());
    }

    public function testCreateMethod()
    {
        $amount = 1;
        $currency = 'USD';
        $this->assertEquals(Money::USD($amount), Money::create($amount, $currency));
        $currency = 'EUR';
        $this->assertEquals(Money::EUR($amount), Money::create($amount, $currency));
        $currency = 'GBP';
        $this->assertEquals(Money::GBP($amount), Money::create($amount, $currency));
        $currency = 'CAD';
        $this->assertEquals(Money::CAD($amount), Money::create($amount, $currency));
    }
}
