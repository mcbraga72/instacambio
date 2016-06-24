<?php

namespace br\com\InstaCambio\Scraper\Strategy;

use br\com\InstaCambio\Model\ExchangeOfficeConfig;

class ScraperStrategyFactoryTest extends \PHPUnit_Framework_TestCase
{
    public function testCheckInstanceForPrimeCashExchangeOffice()
    {
        $exchangeOffice = ExchangeOfficeConfig::get('prime-cash');
        $scraperStrategy = ScraperStrategyBuilder::create($exchangeOffice);
        $this->assertInstanceOf(DefaultScraperStrategy::class, $scraperStrategy);
    }

    public function testCheckInstanceForPmTurimoExchangeOffice()
    {
        $exchangeOffice = ExchangeOfficeConfig::get('pm-turismo');
        $exchangeScraper = ScraperStrategyBuilder::create($exchangeOffice);
        $this->assertInstanceOf(PmTurismoScraperStrategy::class, $exchangeScraper);
        $this->assertSame($exchangeScraper, ScraperStrategyBuilder::create($exchangeOffice));
    }

    public function testCheckInstanceForSomeExchangeOfficesIsSame()
    {
        $exchangeOffice = ExchangeOfficeConfig::get('prime-cash');
        $firstScraperStrategy = ScraperStrategyBuilder::create($exchangeOffice);
        $exchangeOffice = ExchangeOfficeConfig::get('fast-money');
        $secondScraperStrategy = ScraperStrategyBuilder::create($exchangeOffice);
        $exchangeOffice = ExchangeOfficeConfig::get('ecoforte');
        $thirdScraperStrategy = ScraperStrategyBuilder::create($exchangeOffice);

        $this->assertContainsOnlyInstancesOf(DefaultScraperStrategy::class, [$firstScraperStrategy, $secondScraperStrategy, $thirdScraperStrategy]);
        $this->assertSame($firstScraperStrategy, $secondScraperStrategy);
        $this->assertSame($secondScraperStrategy, $thirdScraperStrategy);
        $this->assertSame($thirdScraperStrategy, $firstScraperStrategy);
    }

    public function testCheckInstanceForSagiturExchangeOffice()
    {
        $exchangeOffice = ExchangeOfficeConfig::get('sagitur');
        $exchangeScraper = ScraperStrategyBuilder::create($exchangeOffice);
        $this->assertInstanceOf(SagiturScraperStrategy::class, $exchangeScraper);
        $this->assertSame($exchangeScraper, ScraperStrategyBuilder::create($exchangeOffice));
    }
}
