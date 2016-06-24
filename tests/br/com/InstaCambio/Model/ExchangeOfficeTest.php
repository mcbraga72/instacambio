<?php

namespace br\com\InstaCambio\Model;

class ExchangeOfficeTest extends \PHPUnit_Framework_TestCase
{

    public function testCheckValuesForExchangeOfficePrimeCash()
    {
        $config['nickname'] = 'prime-cash';
        $config['name'] = 'Prime Cash';
        $config['email'] = 'atendimento@primecash.com.br';
        $config['state'] = 'SP';
        $config['city'] = 'sao-paulo';
        $config['delivery'] = true;
        $currencyCardProperties = [
            'url' => 'http://www.primecash.com.br/produtos.html?shop_cat=1',
            'selector' => 'div.produtos.fl',
            'keywords' => ['USD' => ['Dólar Americano', 'USD']],
            'indexesByExchangeRate' => ['USD' => 0]
        ];
        $foreignCurrencyProperties = [
            'url' => 'http://www.primecash.com.br/',
            'selector' => 'div.produtos.fl',
            'keywords' => ['USD' => ['Dólar Americano', 'USD']],
            'indexesByExchangeRate' => ['USD' => 0]
        ];
        $config['currencyCard'] = new CurrencyCard($currencyCardProperties);
        $config['foreignCurrency'] = new ForeignCurrency($foreignCurrencyProperties);
        $exchangeOffice = new ExchangeOffice($config);

        $this->assertEquals($config['nickname'], $exchangeOffice->getNickname());
        $this->assertEquals($config['name'], $exchangeOffice->getName());
        $currencyCard = $exchangeOffice->getCurrencyCard();
        $this->assertEquals($currencyCardProperties['url'], $currencyCard->getUrl());
        $this->assertEquals($currencyCardProperties['selector'], $currencyCard->getSelector());
        $this->assertEquals($currencyCardProperties['keywords'], $currencyCard->getKeywords());
        $this->assertEquals($currencyCardProperties['indexesByExchangeRate'], $currencyCard->getIndexesByExchangeRate());
        $foreignCurrency = $exchangeOffice->getForeignCurrency();
        $this->assertEquals($foreignCurrencyProperties['url'], $foreignCurrency->getUrl());
        $this->assertEquals($foreignCurrencyProperties['selector'], $foreignCurrency->getSelector());
        $this->assertEquals($foreignCurrencyProperties['keywords'], $foreignCurrency->getKeywords());
        $this->assertEquals($foreignCurrencyProperties['indexesByExchangeRate'], $foreignCurrency->getIndexesByExchangeRate());
    }

    public function testGetProductsMethod()
    {
        $config['nickname'] = 'prime-cash';
        $config['name'] = 'Prime Cash';
        $config['email'] = 'atendimento@primecash.com.br';
        $config['state'] = 'SP';
        $config['city'] = 'sao-paulo';
        $config['delivery'] = true;
        $currencyCardProperties = [
            'url' => 'http://www.primecash.com.br/produtos.html?shop_cat=1',
            'selector' => 'div.produtos.fl',
            'keywords' => ['USD' => ['Dólar Americano', 'USD']],
            'indexesByExchangeRate' => ['USD' => 0]
        ];
        $foreignCurrencyProperties = [
            'url' => 'http://www.primecash.com.br/',
            'selector' => 'div.produtos.fl',
            'keywords' => ['USD' => ['Dólar Americano', 'USD']],
            'indexesByExchangeRate' => ['USD' => 0]
        ];
        $config['currencyCard'] = new CurrencyCard($currencyCardProperties);
        $config['foreignCurrency'] = new ForeignCurrency($foreignCurrencyProperties);
        $exchangeOffice = new ExchangeOffice($config);

        $this->assertContains($config['currencyCard'], $exchangeOffice->getProducts(), '', false, false);
        $this->assertContains($config['foreignCurrency'], $exchangeOffice->getProducts(), '', false, false);
    }


}
