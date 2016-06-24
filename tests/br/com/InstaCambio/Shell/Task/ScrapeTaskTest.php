<?php

namespace br\com\InstaCambio\Shell\Task\Scrape;

use br\com\InstaCambio\Config\Database\DatabaseClientBuilder;
use br\com\InstaCambio\Filesystem\Directory;
use br\com\InstaCambio\Filesystem\StubDirectory;
use br\com\InstaCambio\Model\ExchangeOfficeConfig;
use br\com\InstaCambio\Model\ExchangeRate;
use br\com\InstaCambio\Model\ExchangeScrapeResult;
use br\com\InstaCambio\Model\Money;
use br\com\InstaCambio\Stub\StubClient;
use MongoDB\Collection;

class ScrapeTaskTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Directory
     */
    public $directory;

    /**
     * @var Collection
     */
    private $collection;

    private $scraperDirPath;
    private $notScraperDirPath;
    private $lastDirNameInProgressByPageLoader;
    private $firstDirOfThePages;
    private $lastDirOfThePages;
    private $logsDirPath;
    private $pagesDirPath;

    /**
     * @var ScrapeTask
     */
    private $scrapeTask;

    public function testCheckIfDirectoriesWasMovedFromRoodDir()
    {
        $this->assertFileExists($this->pagesDirPath . DS . $this->firstDirOfThePages);
        $this->assertFileExists($this->pagesDirPath . DS . $this->lastDirOfThePages);
        $this->assertFileExists($this->pagesDirPath . DS . $this->lastDirNameInProgressByPageLoader);

        $nicknames = ['prime-cash'];
        $this->scrapeTask->execute($nicknames);

        $this->assertFileNotExists($this->pagesDirPath . DS . $this->firstDirOfThePages);
        $this->assertFileNotExists($this->pagesDirPath . DS . $this->lastDirOfThePages);
        $this->assertFileExists($this->pagesDirPath . DS . $this->lastDirNameInProgressByPageLoader);
    }

    public function testCheckIfDirectoriesMovedForRespectivelyDirectory()
    {
        $this->assertFileExists($this->pagesDirPath . DS . $this->firstDirOfThePages);
        $this->assertFileExists($this->pagesDirPath . DS . $this->lastDirOfThePages);

        $nicknames = ['prime-cash'];
        $this->scrapeTask->execute($nicknames);

        // not exists in vfs_root_dir...
        $this->assertFileNotExists($this->pagesDirPath . DS . $this->firstDirOfThePages, "$this->firstDirOfThePages dir not exists in vfs_root_dir...");
        $this->assertFileNotExists($this->pagesDirPath . DS . $this->lastDirOfThePages, "$this->lastDirOfThePages dir not exists in vfs_root_dir...");

        // but exists in vfs_root_dir/not-scraper
        $this->assertFileExists($this->directory->root() . DS . 'not-scraper' . DS . $this->firstDirOfThePages, "but $this->firstDirOfThePages dir exists in vfs_root_dir/not-scraper");
        // and but exists in vfs_root_dir/scraper
        $this->assertFileExists($this->directory->root() . DS . 'scraper' . DS . $this->lastDirOfThePages, "and $this->lastDirOfThePages dir exists in vfs_root_dir/scraper");
    }

    public function testReturn()
    {
        $exchangeResultExpected = new ExchangeScrapeResult(
            ExchangeOfficeConfig::get('prime-cash'), ['USD' => Money::USD(4.10)]
        );
        $exchangeResults = $this->scrapeTask->execute(['prime-cash']);
        $this->assertEquals($exchangeResultExpected->getMoneys()['USD'], $exchangeResults['prime-cash']->getMoneys()['foreignCurrency']['USD']);
    }

    public function testScrapeExchangeForPrimeCash()
    {
        $exchangeResultExpected = new ExchangeScrapeResult(
            ExchangeOfficeConfig::get('prime-cash'), ['USD' => Money::USD(4.10)]
        );
        $exchangeResults = $this->scrapeTask->execute(['prime-cash']);
        $this->assertEquals($exchangeResultExpected->getExchangeOffice(), $exchangeResults['prime-cash']->getExchangeOffice());
        $this->assertEquals($exchangeResultExpected->getMoneys()['USD'], $exchangeResults['prime-cash']->getMoneys()['foreignCurrency']['USD']);
    }

    public function testScrapeExchangeForTwoExchangeOffices()
    {
        $exchangeResultExpected1 = new ExchangeScrapeResult(
            ExchangeOfficeConfig::get('prime-cash'), ['USD' => Money::USD(4.10)]
        );
        $exchangeResultExpected2 = new ExchangeScrapeResult(
            ExchangeOfficeConfig::get('fast-money'), ['USD' => Money::USD(4.11)]
        );

        $exchangeResults = $this->scrapeTask->execute(['fast-money', 'prime-cash']);
        $this->assertEquals($exchangeResultExpected1->getExchangeOffice(), $exchangeResults['prime-cash']->getExchangeOffice());
        $this->assertEquals($exchangeResultExpected1->getMoneys()['USD'], $exchangeResults['prime-cash']->getMoneys()['foreignCurrency']['USD']);

        $this->assertEquals($exchangeResultExpected2->getExchangeOffice(), $exchangeResults['fast-money']->getExchangeOffice());
        $this->assertEquals($exchangeResultExpected2->getMoneys()['USD'], $exchangeResults['fast-money']->getMoneys()['foreignCurrency']['USD']);
    }

    public function testScrapeForeignCurrencyFor3AV()
    {
        $exchangeResultExpected = new ExchangeScrapeResult(
            ExchangeOfficeConfig::get('threeav'), [
                'foreignCurrency' => ['USD' => Money::USD(3.64), 'EUR' => Money::EUR(4.17), 'GBP' => Money::GBP(5.36), 'CAD' => Money::CAD(2.87)]
            ]
        );

        $exchangeResults = $this->scrapeTask->execute(['threeav']);
        $this->assertEquals($exchangeResultExpected->getExchangeOffice(), $exchangeResults['threeav']->getExchangeOffice());
        $this->assertEquals($exchangeResultExpected->getMoneys()['foreignCurrency']['USD'], $exchangeResults['threeav']->getMoneys()['foreignCurrency']['USD']);
        $this->assertEquals($exchangeResultExpected->getMoneys()['foreignCurrency']['EUR'], $exchangeResults['threeav']->getMoneys()['foreignCurrency']['EUR']);
        $this->assertEquals($exchangeResultExpected->getMoneys()['foreignCurrency']['GBP'], $exchangeResults['threeav']->getMoneys()['foreignCurrency']['GBP']);
        $this->assertEquals($exchangeResultExpected->getMoneys()['foreignCurrency']['CAD'], $exchangeResults['threeav']->getMoneys()['foreignCurrency']['CAD']);
    }

    public function testCheckIfExchangeResultWasSaved()
    {
        $nickname = 'threeav';
        $exchangeResults = $this->scrapeTask->execute([$nickname]);
        $expectedExchangeRate = new ExchangeRate($exchangeResults[$nickname]->getExchangeOffice());
        $expectedExchangeRate
            ->setCurrency('USD')
            ->setIofIncluded(false)
            ->setPrice(3.64)
            ->setProductType('foreignCurrency')
            ->setTrade('buy')
            ->setUpdate(date('c'));
        /* @var $exchangeRateFound ExchangeRate */
        $exchangeRateFound = $this->collection->findOne(['currency' => 'USD', 'exchangeOffice.nickname' => $nickname, 'productType' => 'foreignCurrency'],
            ['sort' => ['$natural' => -1]]
        );
        $this->assertEquals($expectedExchangeRate->getCurrency(), $exchangeRateFound->getCurrency());
        $this->assertEquals($expectedExchangeRate->getPrice(), $exchangeRateFound->getPrice());
    }

    /**
     * @group heavyTest
     */
    public function testRemoveDirectoriesAboveThreeThousand()
    {
        $date = (int)date('YmdHis') + 99;
        for ($i = 0; $i < 1600; $i++) {
            mkdir($this->scraperDirPath . DS . $date . $i);
        }
        $this->assertGreaterThan(1601, count(scandir($this->scraperDirPath)));

        $nickname = 'threeav';
        $exchangeResults = $this->scrapeTask->execute([$nickname]);

        $this->assertEquals(1502, count(scandir($this->scraperDirPath)));
    }


    protected function setUp()
    {
        parent::setUp();
        $this->directory = new StubDirectory('tmp');
        $this->pagesDirPath = $this->directory->root() . DS . 'pages';
        mkdir($this->pagesDirPath);
        $this->scrapeTask = new ScrapeTask('local', $this->directory);

        $this->firstDirOfThePages = (int)date('YmdHis');
        mkdir($this->pagesDirPath . DS . $this->firstDirOfThePages);
        $this->lastDirOfThePages = $this->firstDirOfThePages + 10; // 10 seconds more
        mkdir($this->pagesDirPath . DS . $this->lastDirOfThePages);
        $this->lastDirNameInProgressByPageLoader = $this->lastDirOfThePages + 20 . '-temp'; // 20 seconds more
        mkdir($this->pagesDirPath . DS . $this->lastDirNameInProgressByPageLoader);

        $this->scraperDirPath = $this->directory->root() . DS . 'scraper';
        mkdir($this->scraperDirPath);
        $this->notScraperDirPath = $this->directory->root() . DS . 'not-scraper';
        mkdir($this->notScraperDirPath);
        $this->logsDirPath = $this->directory->root() . DS . 'logs';
        mkdir($this->logsDirPath);

        copy(StubClient::ROOT_DIR_TESTS_FOREIGN_CURRENCY_PAGES . DS . 'threeav.html', $this->pagesDirPath . DS . $this->lastDirOfThePages . DS . 'threeav' . ExchangeOfficeConfig::FOREIGN_CURRENCY_PRODUCT . '.html');
        copy(StubClient::ROOT_DIR_TESTS_FOREIGN_CURRENCY_PAGES . DS . 'threeav.html', $this->pagesDirPath . DS . $this->lastDirOfThePages . DS . 'threeav' . ExchangeOfficeConfig::CURRENCY_CARD_PRODUCT . '.html');
        copy(StubClient::ROOT_DIR_TESTS_FOREIGN_CURRENCY_PAGES . DS . 'prime-cash.html', $this->pagesDirPath . DS . $this->lastDirOfThePages . DS . 'prime-cash' . ExchangeOfficeConfig::FOREIGN_CURRENCY_PRODUCT . '.html');
        copy(StubClient::ROOT_DIR_TESTS_FOREIGN_CURRENCY_PAGES . DS . 'fast-money.html', $this->pagesDirPath . DS . $this->lastDirOfThePages . DS . 'fast-money' . ExchangeOfficeConfig::FOREIGN_CURRENCY_PRODUCT . '.html');

        $this->collection = DatabaseClientBuilder::create('test')->selectCollection('exchangeRates');
        $this->collection->drop();
    }

    protected function tearDown()
    {
        parent::tearDown();
        unset($this->directory);
        unset($this->scrapeTask);
        $this->collection->drop();
    }

}
