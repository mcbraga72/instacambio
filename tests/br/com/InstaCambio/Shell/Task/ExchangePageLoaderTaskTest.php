<?php

namespace br\com\InstaCambio\Shell\Task\PageLoader;

use br\com\InstaCambio\Filesystem\Directory;
use br\com\InstaCambio\Filesystem\StubDirectory;
use br\com\InstaCambio\Model\ExchangeOfficeConfig;

class ExchangePageLoaderTaskTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Directory
     */
    private $directory;

    /**
     * @var ExchangePageLoaderTask
     */
    private $exchangePageLoader;

    public function testCheckHtmlFileExists()
    {
        $nickname = 'ecoforte';
        $this->assertFileNotExists($this->directory->root() . DS . $nickname . ExchangeOfficeConfig::FOREIGN_CURRENCY_PRODUCT . '.html');

        $this->exchangePageLoader->execute([$nickname]);

        $this->assertFileExists($this->directory->root() . DS . $nickname . ExchangeOfficeConfig::FOREIGN_CURRENCY_PRODUCT . '.html');
    }

    public function testCheckIfHtmlFilesExistsForTwoExchangeOffices()
    {
        $primeCash = 'prime-cash';
        $fastMoney = 'fast-money';
        $nicknames = [$primeCash, $fastMoney];
        $this->assertFileNotExists($this->directory->root() . DS . $primeCash . ExchangeOfficeConfig::CURRENCY_CARD_PRODUCT . '.html');
        $this->assertFileNotExists($this->directory->root() . DS . $primeCash . ExchangeOfficeConfig::FOREIGN_CURRENCY_PRODUCT . '.html');
        $this->assertFileNotExists($this->directory->root() . DS . $fastMoney . ExchangeOfficeConfig::CURRENCY_CARD_PRODUCT . '.html');
        $this->assertFileNotExists($this->directory->root() . DS . $fastMoney . ExchangeOfficeConfig::FOREIGN_CURRENCY_PRODUCT . '.html');

        $this->exchangePageLoader->execute($nicknames);

        $this->assertFileExists($this->directory->root() . DS . $primeCash . ExchangeOfficeConfig::CURRENCY_CARD_PRODUCT . '.html');
        $this->assertFileExists($this->directory->root() . DS . $primeCash . ExchangeOfficeConfig::FOREIGN_CURRENCY_PRODUCT . '.html');
        $this->assertFileNotExists($this->directory->root() . DS . $fastMoney . ExchangeOfficeConfig::CURRENCY_CARD_PRODUCT . '.html');
        $this->assertFileExists($this->directory->root() . DS . $fastMoney . ExchangeOfficeConfig::FOREIGN_CURRENCY_PRODUCT . '.html');
    }

    /**
     * @group integratedUnitTest
     */
    public function testLoadInterpretedPageUsingWebDriver()
    {

        $beeCambio = 'bee-cambio';
        $europa = 'europa';
        $nicknames = [$beeCambio, $europa];
        $this->assertFileNotExists($this->directory->root() . DS . $beeCambio . ExchangeOfficeConfig::CURRENCY_CARD_PRODUCT . '.html');
        $this->assertFileNotExists($this->directory->root() . DS . $beeCambio . ExchangeOfficeConfig::FOREIGN_CURRENCY_PRODUCT . '.html');
        $this->assertFileNotExists($this->directory->root() . DS . $europa . ExchangeOfficeConfig::CURRENCY_CARD_PRODUCT . '.html');
        $this->assertFileNotExists($this->directory->root() . DS . $europa . ExchangeOfficeConfig::FOREIGN_CURRENCY_PRODUCT . '.html');

        $environment = 'remote';
        $this->directory = new StubDirectory('tmp/' . date('YmdHis'));
        mkdir(dirname(dirname($this->directory->root())) . DS . 'logs');
        $this->exchangePageLoader = new ExchangePageLoaderTask($environment, $this->directory);
        $this->exchangePageLoader->execute($nicknames);

        $this->assertFileNotExists($this->directory->root() . DS . $beeCambio . ExchangeOfficeConfig::CURRENCY_CARD_PRODUCT . '.html');
        $this->assertFileExists($this->directory->root() . DS . $beeCambio . ExchangeOfficeConfig::FOREIGN_CURRENCY_PRODUCT . '.html');
        $this->assertFileExists($this->directory->root() . DS . $europa . ExchangeOfficeConfig::CURRENCY_CARD_PRODUCT . '.html');
        $this->assertFileExists($this->directory->root() . DS . $europa . ExchangeOfficeConfig::FOREIGN_CURRENCY_PRODUCT . '.html');
    }

    protected function setUp()
    {
        parent::setUp();

        $environment = 'local';
        $this->directory = new StubDirectory('tmp/' . date('YmdHis'));
        mkdir(dirname(dirname($this->directory->root())) . DS . 'logs');
        $this->exchangePageLoader = new ExchangePageLoaderTask($environment, $this->directory);
    }


}
