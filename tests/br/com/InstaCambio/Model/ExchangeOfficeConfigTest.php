<?php

namespace br\com\InstaCambio\Model;

class ExchangeOfficeConfigTest extends \PHPUnit_Framework_TestCase
{

    public function testGetExchangeOfficeForPrimeCash()
    {
        $exchangeOffice = ExchangeOfficeConfig::get('prime-cash');
        $this->assertEquals('Prime Cash', $exchangeOffice->getName());
        $this->assertEquals('prime-cash', $exchangeOffice->getNickname());
        $this->assertEquals('http://www.primecash.com.br/produtos.html?shop_cat=2', $exchangeOffice->getForeignCurrency()->getUrl());
        $this->assertEquals('div.produtos.fl', $exchangeOffice->getForeignCurrency()->getSelector());
        $this->assertEquals(['Dólar Americano', 'USD'], $exchangeOffice->getForeignCurrency()->getKeywords()['USD']);
        $this->assertArraySubset(['USD' => 0], $exchangeOffice->getForeignCurrency()->getIndexesByExchangeRate());
    }

    public function testBuildExchangeOfficeForFastMoney()
    {
        $exchangeOffice = ExchangeOfficeConfig::get('fast-money');
        $this->assertEquals('Fast Money', $exchangeOffice->getName());
        $this->assertEquals('fast-money', $exchangeOffice->getNickname());
        $this->assertEquals('http://www.fastmoneytour.com.br/cotacao-de-moeda-fast-money-tour.php', $exchangeOffice->getForeignCurrency()->getUrl());
        $this->assertEquals('div.ticker ul li', $exchangeOffice->getForeignCurrency()->getSelector());
        $this->assertEquals(['Dólar Americano'], $exchangeOffice->getForeignCurrency()->getKeywords()['USD']);
        $this->assertArraySubset(['USD' => 1], $exchangeOffice->getForeignCurrency()->getIndexesByExchangeRate());
    }

    public function testGetProductByTypeMethod()
    {
        $exchangeOffice = ExchangeOfficeConfig::get('prime-cash');
        $exchangeProduct = ExchangeOfficeConfig::getProductByType($exchangeOffice, ExchangeOfficeConfig::FOREIGN_CURRENCY_PRODUCT);
        $this->assertInstanceOf(ExchangeOfficeProduct::class, $exchangeProduct);
        $this->assertInstanceOf(ForeignCurrency::class, $exchangeProduct);

        $exchangeProduct = ExchangeOfficeConfig::getProductByType($exchangeOffice, ExchangeOfficeConfig::CURRENCY_CARD_PRODUCT);
        $this->assertInstanceOf(ExchangeOfficeProduct::class, $exchangeProduct);
        $this->assertInstanceOf(CurrencyCard::class, $exchangeProduct);

        $exchangeOffice = ExchangeOfficeConfig::get('fast-money');
        $exchangeProduct = ExchangeOfficeConfig::getProductByType($exchangeOffice, ExchangeOfficeConfig::FOREIGN_CURRENCY_PRODUCT);
        $this->assertInstanceOf(ExchangeOfficeProduct::class, $exchangeProduct);
        $this->assertInstanceOf(ForeignCurrency::class, $exchangeProduct);

        $exchangeProduct = ExchangeOfficeConfig::getProductByType($exchangeOffice, ExchangeOfficeConfig::CURRENCY_CARD_PRODUCT);
        $this->assertNull($exchangeProduct);
    }

    public function testGetAllMethod()
    {
        $exchangeOffices = ExchangeOfficeConfig::getAll(['fast-money', 'prime-cash']);
        $this->assertCount(2, $exchangeOffices);
        $this->assertContains(ExchangeOfficeConfig::get('fast-money'), $exchangeOffices, '', false, false);
        $this->assertContains(ExchangeOfficeConfig::get('prime-cash'), $exchangeOffices, '', false, false);
    }

}
