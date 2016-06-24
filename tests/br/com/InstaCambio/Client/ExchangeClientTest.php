<?php

namespace br\com\InstaCambio\Client;

use br\com\InstaCambio\Model\CurrencyCard;
use br\com\InstaCambio\Model\ExchangeOffice;
use br\com\InstaCambio\Model\ExchangeOfficeConfig;
use br\com\InstaCambio\Model\ForeignCurrency;
use br\com\InstaCambio\Stub\StubClient;
use Psr\Http\Message\ResponseInterface;

class ExchangeClientTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @var ExchangeClient
     */
    protected $exchangeClient;

    public function testGenerateDocumentByForeignCurrencyProductPrimeCash()
    {
        $exchangeOffice = ExchangeOfficeConfig::get('prime-cash');
        $actual = $this->exchangeClient->generateDocument($exchangeOffice, ExchangeOfficeConfig::FOREIGN_CURRENCY_PRODUCT);
        $this->assertContains('dólar americano', $actual->getCrawler()->html(), '', true);
        $this->assertContains('USD', $actual->getCrawler()->html(), '', true);
    }

    public function testGenerateDocumentByCurrencyCardProductForPrimeCash()
    {
        $exchangeOffice = ExchangeOfficeConfig::get('prime-cash');
        $actual = $this->exchangeClient->generateDocument($exchangeOffice, ExchangeOfficeConfig::CURRENCY_CARD_PRODUCT);
        $this->assertContains('Visa Travel Money - Dólar (USD)', $actual->getCrawler()->html(), '', true);
    }

    public function testGenerateDocumentByForeignCurrencyProductEcoforte()
    {
        $exchangeOffice = ExchangeOfficeConfig::get('ecoforte');
        $actual = $this->exchangeClient->generateDocument($exchangeOffice, ExchangeOfficeConfig::FOREIGN_CURRENCY_PRODUCT);
        $this->assertContains('NOSSOS PRODUTOS', $actual->getCrawler()->html(), '', true);
    }

    public function testGenerateDocumentByCurrencyCardProductEcoforte()
    {
        $exchangeOffice = ExchangeOfficeConfig::get('ecoforte');
        $actual = $this->exchangeClient->generateDocument($exchangeOffice, ExchangeOfficeConfig::CURRENCY_CARD_PRODUCT);
        $this->assertContains('VISA TRAVEL MONEY (VTM)', $actual->getCrawler()->html(), '', true);
        $this->assertEquals(ExchangeOfficeConfig::CURRENCY_CARD_PRODUCT, $actual->productType());
    }

    public function testUtf8DecodedGenerateDocumentByForeignCurrencyProductForGraco()
    {
        $exchangeOffice = ExchangeOfficeConfig::get('graco');
        $exchangeDocument = $this->exchangeClient->generateDocument($exchangeOffice, ExchangeOfficeConfig::FOREIGN_CURRENCY_PRODUCT);
        $this->assertContains('Dólar Americano', $exchangeDocument->getCrawler()->html());
        $this->assertEquals(ExchangeOfficeConfig::FOREIGN_CURRENCY_PRODUCT, $exchangeDocument->productType());
    }

    public function testUtf8DecodedGenerateDocumentByForeignCurrencyProductForQuatroCantos()
    {
        $exchangeOffice = ExchangeOfficeConfig::get('quatro-cantos');
        $exchangeDocument = $this->exchangeClient->generateDocument($exchangeOffice, ExchangeOfficeConfig::FOREIGN_CURRENCY_PRODUCT);
        $this->assertContains('dólar (usd)', $exchangeDocument->getCrawler()->html(), '', true);
        $this->assertEquals(ExchangeOfficeConfig::FOREIGN_CURRENCY_PRODUCT, $exchangeDocument->productType());
    }

    public function testGenerateDocumentByCurrencyCardProductConexion()
    {
        $exchangeOffice = ExchangeOfficeConfig::get('conexion');
        $actual = $this->exchangeClient->generateDocument($exchangeOffice, ExchangeOfficeConfig::FOREIGN_CURRENCY_PRODUCT);
        $this->assertContains('Dólar Turismo', $actual->getCrawler()->html(), '', true);
        $this->assertEquals(ExchangeOfficeConfig::FOREIGN_CURRENCY_PRODUCT, $actual->productType());
    }

    public function testChecksIfExchangeDocumentComposingTheExchangeOffice()
    {
        $exchangeOffice = ExchangeOfficeConfig::get('prime-cash');
        $actual = $this->exchangeClient->generateDocument($exchangeOffice, ExchangeOfficeConfig::FOREIGN_CURRENCY_PRODUCT);
        $this->assertEquals($exchangeOffice, $actual->getExchangeOffice());
    }

    public function testChecksIfReturnInstanceOfRequestInterface()
    {
        $exchangeOffice = ExchangeOfficeConfig::get('prime-cash');
        $exchangeOfficeProduct = ExchangeOfficeConfig::getProductByType($exchangeOffice, ExchangeOfficeConfig::FOREIGN_CURRENCY_PRODUCT);
        $response = $this->exchangeClient->send($exchangeOffice, $exchangeOfficeProduct);
        $this->assertInstanceOf(ResponseInterface::class, $response);
    }

    public function testChecksIfHtmlContentIsEquals()
    {
        $nickname = 'prime-cash';
        $exchangeOffice = ExchangeOfficeConfig::get($nickname);
        $exchangeOfficeProduct = ExchangeOfficeConfig::getProductByType($exchangeOffice, ExchangeOfficeConfig::FOREIGN_CURRENCY_PRODUCT);
        $response = $this->exchangeClient->send($exchangeOffice, $exchangeOfficeProduct);

        $content = file_get_contents(StubClient::ROOT_DIR_TESTS_PAGES . DS . 'foreign-currency' . DS . $nickname . '.html');
        $this->assertEquals($content, $response->getBody()->getContents());
        $this->assertEquals(200, $response->getStatusCode());
    }

    /**
     * @group integratedUnitTest
     */
    public function testChecksIfDocumentContainsKeywordsOfTheExchangeOfficeEuropa()
    {
        $exchangeOffice = ExchangeOfficeConfig::get('europa');
        $this->exchangeClient = new ExchangeClient('remote');
        $actual = $this->exchangeClient->generateDocument($exchangeOffice, ExchangeOfficeConfig::FOREIGN_CURRENCY_PRODUCT);
        $product = ExchangeOfficeConfig::getProductByType($exchangeOffice, ExchangeOfficeConfig::FOREIGN_CURRENCY_PRODUCT);
        foreach ($product->getKeywords() as $currency => $keywords) {
            $this->assertContains(implode($keywords), $actual->getCrawler()->html());
        }
    }

    /**
     * @group integratedUnitTest
     */
    public function testChecksIfDocumentContainsKeywordsOfTheExchangeOfficeBeeCambio()
    {
        $exchangeOffice = ExchangeOfficeConfig::get('bee-cambio');
        $this->exchangeClient = new ExchangeClient('remote');
        $actual = $this->exchangeClient->generateDocument($exchangeOffice, ExchangeOfficeConfig::FOREIGN_CURRENCY_PRODUCT);
        $product = ExchangeOfficeConfig::getProductByType($exchangeOffice, ExchangeOfficeConfig::FOREIGN_CURRENCY_PRODUCT);
        foreach ($product->getKeywords() as $currency => $keywords) {
            $this->assertContains(implode($keywords), $actual->getCrawler()->html());
        }
    }

    /**
     * @group integratedUnitTest
     */
    public function testChecksIfDocumentContainsKeywordsOfTheExchangeOfficeLHX()
    {
        $exchangeOffice = ExchangeOfficeConfig::get('lhx');
        $this->exchangeClient = new ExchangeClient('remote');
        $actual = $this->exchangeClient->generateDocument($exchangeOffice, ExchangeOfficeConfig::FOREIGN_CURRENCY_PRODUCT);
        $product = ExchangeOfficeConfig::getProductByType($exchangeOffice, ExchangeOfficeConfig::FOREIGN_CURRENCY_PRODUCT);
        foreach ($product->getKeywords() as $currency => $keywords) {
            $this->assertContains(implode($keywords), $actual->getCrawler()->html());
        }
    }

    /**
     * @expectedException \br\com\InstaCambio\Client\ExchangeClientException
     */
    public function testSendMethodThrowsExceptionIfThereIsAnErrorInTheRequestUsingStaticClient()
    {
        $exchangeOffice = $this->getExchangeOfficeWithUrlNotFound('prime-cash');
        $exchangeOfficeProduct = ExchangeOfficeConfig::getProductByType($exchangeOffice, ExchangeOfficeConfig::FOREIGN_CURRENCY_PRODUCT);
        $this->exchangeClient->send($exchangeOffice, $exchangeOfficeProduct);
    }

    /**
     * @return ExchangeOffice
     */
    private function getExchangeOfficeWithUrlNotFound($nickname)
    {
        $config['nickname'] = $nickname;
        $config['name'] = $nickname;
        $config['email'] = "{$nickname}@{$nickname}.com.br";
        $config['state'] = 'SP';
        $config['city'] = 'sao-paulo';
        $config['delivery'] = true;
        $currencyCardProperties = [
            'url' => 'https://httpbin.org/hidden-basic-auth/user/passwd',
            'selector' => 'id.class.selector',
            'keywords' => ['USD' => ['Dólar Americano', 'USD']],
            'indexesByExchangeRate' => ['USD' => 0]
        ];
        $foreignCurrencyProperties = [
            'url' => 'https://httpbin.org/hidden-basic-auth/user/passwd',
            'selector' => 'id.class.selector',
            'keywords' => ['USD' => ['Dólar Americano', 'USD']],
            'indexesByExchangeRate' => ['USD' => 0]
        ];
        $config['currencyCard'] = new CurrencyCard($currencyCardProperties);
        $config['foreignCurrency'] = new ForeignCurrency($foreignCurrencyProperties);
        $exchangeOffice = new ExchangeOffice($config);
        return $exchangeOffice;
    }

    /**
     * @expectedException \br\com\InstaCambio\Client\ExchangeClientException
     */
    public function testSendMethodThrowsExceptionIfThereIsAnErrorInTheRequestUsingLocalInterpreterClient()
    {
        $exchangeOffice = $this->getExchangeOfficeWithUrlNotFound('europa');
        $exchangeOfficeProduct = ExchangeOfficeConfig::getProductByType($exchangeOffice, ExchangeOfficeConfig::FOREIGN_CURRENCY_PRODUCT);
        $this->exchangeClient->send($exchangeOffice, $exchangeOfficeProduct);
    }

    /**
     * @expectedException \br\com\InstaCambio\Client\ExchangeClientException
     * @group integratedUnitTest
     */
    public function testSendMethodThrowsExceptionIfThereIsAnErrorInTheRequestUsingRemoteStaticClient()
    {
        $this->exchangeClient = new ExchangeClient('remote');
        $exchangeOffice = $this->getExchangeOfficeWithUrlNotFound('prime-cash');
        $exchangeOfficeProduct = ExchangeOfficeConfig::getProductByType($exchangeOffice, ExchangeOfficeConfig::FOREIGN_CURRENCY_PRODUCT);
        $this->exchangeClient->send($exchangeOffice, $exchangeOfficeProduct);
    }

    /**
     * @expectedException \br\com\InstaCambio\Client\ExchangeClientException
     * @group integratedUnitTest
     */
    public function testSendMethodThrowsExceptionIfThereIsAnErrorInTheRequestUsingRemoteInterpreterClient()
    {
        $this->exchangeClient = new ExchangeClient('remote');
        $exchangeOffice = $this->getExchangeOfficeWithUrlNotFound('europa');
        $exchangeOfficeProduct = ExchangeOfficeConfig::getProductByType($exchangeOffice, ExchangeOfficeConfig::FOREIGN_CURRENCY_PRODUCT);
        $this->exchangeClient->send($exchangeOffice, $exchangeOfficeProduct);
    }

    protected function setUp()
    {
        parent::setUp();
        $this->exchangeClient = new ExchangeClient('local');
    }

}
