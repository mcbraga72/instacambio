<?php

namespace br\com\InstaCambio\Scraper;

use br\com\InstaCambio\Client\ExchangeClient;
use br\com\InstaCambio\Model\ExchangeOffice;
use br\com\InstaCambio\Model\ExchangeOfficeConfig;
use br\com\InstaCambio\Model\ForeignCurrency;
use br\com\InstaCambio\Model\Money;

/**
 *
 * @property ExchangeScraper scraper
 * @property ExchangeClient client
 */
class ExchangeScraperTest extends \PHPUnit_Framework_TestCase
{
    public function testScrapeCurrenciesForAmazonia()
    {
        $exchangeOffice = ExchangeOfficeConfig::get('amazonia');
        $exchangeDocument = $this->client->generateDocument($exchangeOffice, ExchangeOfficeConfig::FOREIGN_CURRENCY_PRODUCT);
        $moneys = $this->scraper->scrapeExchangeRates($exchangeDocument);

        $this->assertEquals(Money::USD(3.85), $moneys['USD']);
        $this->assertEquals(Money::CAD(3.16), $moneys['CAD']);
        $this->assertEquals(Money::EUR(4.22), $moneys['EUR']);
        $this->assertEquals(Money::GBP(5.82), $moneys['GBP']);
        $this->assertEquals(Money::CHF(4.22), $moneys['CHF']);
        $this->assertEquals(Money::JPY(0.054), $moneys['JPY']);
    }

    public function testScrapeCurrenciesForThreeAV()
    {
        $exchangeOffice = ExchangeOfficeConfig::get('threeav');
        $exchangeDocument = $this->client->generateDocument($exchangeOffice, ExchangeOfficeConfig::FOREIGN_CURRENCY_PRODUCT);
        $moneys = $this->scraper->scrapeExchangeRates($exchangeDocument);

        $this->assertEquals(Money::USD(3.64), $moneys['USD']);
        $this->assertEquals(Money::EUR(4.17), $moneys['EUR']);
        $this->assertEquals(Money::GBP(5.36), $moneys['GBP']);
        $this->assertEquals(Money::ARS(0.32), $moneys['ARS']);
        $this->assertEquals(Money::CLP(0.0062), $moneys['CLP']);
        $this->assertEquals(Money::CHF(3.86), $moneys['CHF']);
        $this->assertEquals(Money::AUD(2.73), $moneys['AUD']);
        $this->assertEquals(Money::CAD(2.87), $moneys['CAD']);
        $this->assertEquals(Money::NZD(2.70), $moneys['NZD']);
        $this->assertEquals(Money::JPY(0.0369), $moneys['JPY']);
        $this->assertEquals(Money::COP(0.0015), $moneys['COP']);
        $this->assertEquals(Money::UYU(0.14), $moneys['UYU']);
        $this->assertEquals(Money::MXN(0.24), $moneys['MXN']);
        $this->assertEquals(Money::CNY(0.6520), $moneys['CNY']);
        $this->assertEquals(Money::PEN(1.28), $moneys['PEN']);
    }

    public function testScrapeCurrencyCardForThreeAV()
    {
        $exchangeOffice = ExchangeOfficeConfig::get('threeav');
        $exchangeDocument = $this->client->generateDocument($exchangeOffice, ExchangeOfficeConfig::CURRENCY_CARD_PRODUCT);
        $moneys = $this->scraper->scrapeExchangeRates($exchangeDocument);

        $this->assertEquals(Money::USD(3.62), $moneys['USD']);
        $this->assertEquals(Money::EUR(4.17), $moneys['EUR']);
        $this->assertEquals(Money::GBP(5.36), $moneys['GBP']);
        $this->assertEquals(Money::AUD(2.73), $moneys['AUD']);
        $this->assertEquals(Money::CAD(2.87), $moneys['CAD']);
    }

    public function testScrapeCurrenciesForDibran()
    {
        $exchangeOffice = ExchangeOfficeConfig::get('dibran');
        $exchangeDocument = $this->client->generateDocument($exchangeOffice, ExchangeOfficeConfig::FOREIGN_CURRENCY_PRODUCT);
        $moneys = $this->scraper->scrapeExchangeRates($exchangeDocument);

        $this->assertEquals(Money::USD(3.79), $moneys['USD']);
        $this->assertEquals(Money::EUR(4.22), $moneys['EUR']);
    }

    public function testScrapeCurrenciesForTorre()
    {
        $exchangeOffice = ExchangeOfficeConfig::get('torre');
        $exchangeDocument = $this->client->generateDocument($exchangeOffice, ExchangeOfficeConfig::FOREIGN_CURRENCY_PRODUCT);
        $moneys = $this->scraper->scrapeExchangeRates($exchangeDocument);

        $this->assertEquals(Money::USD(4.04000), $moneys['USD']);
        $this->assertEquals(Money::EUR(4.41000), $moneys['EUR']);
        $this->assertEquals(Money::GBP(5.81000), $moneys['GBP']);
        $this->assertEquals(Money::JPY(0.03720), $moneys['JPY']);
    }

    public function testScrapeCurrencyCardForTorre()
    {
        $exchangeOffice = ExchangeOfficeConfig::get('torre');
        $exchangeDocument = $this->client->generateDocument($exchangeOffice, ExchangeOfficeConfig::CURRENCY_CARD_PRODUCT);
        $moneys = $this->scraper->scrapeExchangeRates($exchangeDocument);

        $this->assertEquals(Money::USD(4.03000), $moneys['USD']);
        $this->assertEquals(Money::EUR(4.39000), $moneys['EUR']);
        $this->assertEquals(Money::GBP(5.75000), $moneys['GBP']);
    }

    public function testScrapeCurrenciesForStartStrips()
    {
        $exchangeOffice = ExchangeOfficeConfig::get('start-trips');
        $exchangeDocument = $this->client->generateDocument($exchangeOffice, ExchangeOfficeConfig::FOREIGN_CURRENCY_PRODUCT);
        $moneys = $this->scraper->scrapeExchangeRates($exchangeDocument);

        $this->assertEquals(Money::USD(4.04), $moneys['USD']);
        $this->assertEquals(Money::EUR(4.40), $moneys['EUR']);
        $this->assertEquals(Money::GBP(5.87), $moneys['GBP']);
        $this->assertEquals(Money::CAD(3.14), $moneys['CAD']);
        $this->assertEquals(Money::AUD(3.11), $moneys['AUD']);
        $this->assertEquals(Money::ARS(0.33), $moneys['ARS']);
        $this->assertEquals(Money::NZD(2.94), $moneys['NZD']);
        $this->assertEquals(Money::CHF(4.30), $moneys['CHF']);
        $this->assertEquals(Money::UYU(0.16), $moneys['UYU']);
        $this->assertEquals(Money::JPY(0.04), $moneys['JPY']);
    }

    public function testScrapeCurrenciesForSagitur()
    {
        $exchangeOffice = ExchangeOfficeConfig::get('sagitur');
        $exchangeDocument = $this->client->generateDocument($exchangeOffice, ExchangeOfficeConfig::FOREIGN_CURRENCY_PRODUCT);
        $moneys = $this->scraper->scrapeExchangeRates($exchangeDocument);

        $this->assertEquals(Money::ARS(0.30), $moneys['ARS']);
        $this->assertEquals(Money::CLP(0.0063), $moneys['CLP']);
        $this->assertEquals(Money::JPY(0.038), $moneys['JPY']);
        $this->assertEquals(Money::CAD(2.98), $moneys['CAD']);
        $this->assertEquals(Money::USD(3.67), $moneys['USD']);
        $this->assertEquals(Money::EUR(4.22), $moneys['EUR']);
        $this->assertEquals(Money::GBP(5.42), $moneys['GBP']);
        $this->assertEquals(Money::CHF(3.90), $moneys['CHF']);
    }

    public function testScrapeCurrenciesForOurominas()
    {
        $exchangeOffice = ExchangeOfficeConfig::get('ourominas');
        $exchangeDocument = $this->client->generateDocument($exchangeOffice, ExchangeOfficeConfig::FOREIGN_CURRENCY_PRODUCT);
        $moneys = $this->scraper->scrapeExchangeRates($exchangeDocument);

        $this->assertEquals(Money::USD(3.6360), $moneys['USD']);
        $this->assertEquals(Money::EUR(4.0703), $moneys['EUR']);
        $this->assertEquals(Money::GBP(5.2924), $moneys['GBP']);
        $this->assertEquals(Money::AUD(2.7976), $moneys['AUD']);
        $this->assertEquals(Money::CAD(2.9290), $moneys['CAD']);
        $this->assertEquals(Money::NZD(2.6765), $moneys['NZD']);
        $this->assertEquals(Money::CHF(3.9390), $moneys['CHF']);
        $this->assertEquals(Money::JPY(0.0365), $moneys['JPY']);
        $this->assertEquals(Money::CNY(0.6060), $moneys['CNY']);
        $this->assertEquals(Money::ARS(0.2828), $moneys['ARS']);
        $this->assertEquals(Money::CLP(0.0058), $moneys['CLP']);
        $this->assertEquals(Money::MXN(0.2121), $moneys['MXN']);
        $this->assertEquals(Money::UYU(0.1313), $moneys['UYU']);
        $this->assertEquals(Money::COP(0.0014), $moneys['COP']);
        $this->assertEquals(Money::ZAR(0.2626), $moneys['ZAR']);
        $this->assertEquals(Money::ILS(1.0201), $moneys['ILS']);
    }

    public function testScrapeCurrencyCardForOurominas()
    {
        $exchangeOffice = ExchangeOfficeConfig::get('ourominas');
        $exchangeDocument = $this->client->generateDocument($exchangeOffice, ExchangeOfficeConfig::CURRENCY_CARD_PRODUCT);
        $moneys = $this->scraper->scrapeExchangeRates($exchangeDocument);

        $this->assertEquals(Money::USD(3.8046), $moneys['USD']);
        $this->assertEquals(Money::EUR(4.2722), $moneys['EUR']);
        $this->assertEquals(Money::GBP(5.3987), $moneys['GBP']);
    }

    public function testScrapeCurrenciesForAGK()
    {
        $exchangeOffice = ExchangeOfficeConfig::get('agk');
        $exchangeDocument = $this->client->generateDocument($exchangeOffice, ExchangeOfficeConfig::FOREIGN_CURRENCY_PRODUCT);
        $moneys = $this->scraper->scrapeExchangeRates($exchangeDocument);

        $this->assertEquals(Money::USD(4.0800), $moneys['USD']);
        $this->assertEquals(Money::EUR(4.4200), $moneys['EUR']);
        $this->assertEquals(Money::GBP(5.8400), $moneys['GBP']);
        $this->assertEquals(Money::ARS(0.3500), $moneys['ARS']);
        $this->assertEquals(Money::AUD(3.0500), $moneys['AUD']);
        $this->assertEquals(Money::CAD(3.1200), $moneys['CAD']);
        $this->assertEquals(Money::CLP(0.0065), $moneys['CLP']);
        $this->assertEquals(Money::JPY(0.0420), $moneys['JPY']);
        $this->assertEquals(Money::MXN(0.2900), $moneys['MXN']);
        $this->assertEquals(Money::UYU(0.1700), $moneys['UYU']);
        $this->assertEquals(Money::NZD(2.9300), $moneys['NZD']);
        $this->assertEquals(Money::CNY(0.7300), $moneys['CNY']);
        $this->assertEquals(Money::CHF(3.6900), $moneys['CHF']);
    }

    public function testScrapeCurrencyCardForAGK()
    {
        $exchangeOffice = ExchangeOfficeConfig::get('agk');
        $exchangeDocument = $this->client->generateDocument($exchangeOffice, ExchangeOfficeConfig::CURRENCY_CARD_PRODUCT);
        $moneys = $this->scraper->scrapeExchangeRates($exchangeDocument);

        $this->assertEquals(Money::USD(3.9900), $moneys['USD']);
        $this->assertEquals(Money::EUR(4.3300), $moneys['EUR']);
        $this->assertEquals(Money::GBP(5.8100), $moneys['GBP']);
        $this->assertEquals(Money::ARS(0.3500), $moneys['ARS']);
        $this->assertEquals(Money::AUD(2.9600), $moneys['AUD']);
        $this->assertEquals(Money::CAD(3.0200), $moneys['CAD']);
    }

    public function testScrapeCurrenciesForBestMoney()
    {
        $exchangeOffice = ExchangeOfficeConfig::get('best-money');
        $exchangeDocument = $this->client->generateDocument($exchangeOffice, ExchangeOfficeConfig::FOREIGN_CURRENCY_PRODUCT);
        $moneys = $this->scraper->scrapeExchangeRates($exchangeDocument);

        $this->assertEquals(Money::USD(3.98), $moneys['USD']);
        $this->assertEquals(Money::AUD(3.09), $moneys['AUD']);
        $this->assertEquals(Money::CAD(3.15), $moneys['CAD']);
        $this->assertEquals(Money::EUR(4.43), $moneys['EUR']);
        $this->assertEquals(Money::CHF(4.18), $moneys['CHF']);
        $this->assertEquals(Money::GBP(5.83), $moneys['GBP']);
        $this->assertEquals(Money::ARS(0.30), $moneys['ARS']);
        $this->assertEquals(Money::CLP(0.0065), $moneys['CLP']);
        $this->assertEquals(Money::MXN(0.26), $moneys['MXN']);
        $this->assertEquals(Money::UYU(0.15), $moneys['UYU']);
    }

    public function testScrapeCurrenciesForSPMundi()
    {
        $exchangeOffice = ExchangeOfficeConfig::get('sp-mundi');
        $exchangeDocument = $this->client->generateDocument($exchangeOffice, ExchangeOfficeConfig::FOREIGN_CURRENCY_PRODUCT);
        $moneys = $this->scraper->scrapeExchangeRates($exchangeDocument);

        $this->assertEquals(Money::USD(3.70), $moneys['USD']);
        $this->assertEquals(Money::EUR(4.21), $moneys['EUR']);
        $this->assertEquals(Money::CAD(2.91), $moneys['CAD']);
        $this->assertEquals(Money::GBP(5.42), $moneys['GBP']);
        $this->assertEquals(Money::AUD(2.79), $moneys['AUD']);
        $this->assertEquals(Money::ARS(0.29), $moneys['ARS']);
        $this->assertEquals(Money::CLP(0.0061), $moneys['CLP']);
        $this->assertEquals(Money::JPY(0.0359), $moneys['JPY']);
        $this->assertEquals(Money::MXN(0.225), $moneys['MXN']);
        $this->assertEquals(Money::CHF(3.93), $moneys['CHF']);
        $this->assertEquals(Money::CNY(0.619), $moneys['CNY']);
        $this->assertEquals(Money::NZD(2.63), $moneys['NZD']);
        $this->assertEquals(Money::UYU(0.13), $moneys['UYU']);
    }

    public function testScrapeCurrencyCardForSPMundi()
    {
        $exchangeOffice = ExchangeOfficeConfig::get('sp-mundi');
        $exchangeDocument = $this->client->generateDocument($exchangeOffice, ExchangeOfficeConfig::CURRENCY_CARD_PRODUCT);
        $moneys = $this->scraper->scrapeExchangeRates($exchangeDocument);

        $this->assertEquals(Money::USD(3.64), $moneys['USD']);
        $this->assertEquals(Money::EUR(4.13), $moneys['EUR']);
        $this->assertEquals(Money::CAD(2.85), $moneys['CAD']);
        $this->assertEquals(Money::GBP(5.26), $moneys['GBP']);
        $this->assertEquals(Money::AUD(2.69), $moneys['AUD']);
        $this->assertEquals(Money::NZD(2.53), $moneys['NZD']);
    }

    public function testScrapeCurrenciesForARRM()
    {
        $exchangeOffice = ExchangeOfficeConfig::get('arrm');
        $exchangeDocument = $this->client->generateDocument($exchangeOffice, ExchangeOfficeConfig::FOREIGN_CURRENCY_PRODUCT);
        $moneys = $this->scraper->scrapeExchangeRates($exchangeDocument);

        $this->assertEquals(Money::USD(3.8700), $moneys['USD']);
        $this->assertEquals(Money::AUD(3.0400), $moneys['AUD']);
        $this->assertEquals(Money::CAD(3.0500), $moneys['CAD']);
        $this->assertEquals(Money::EUR(4.2600), $moneys['EUR']);
        $this->assertEquals(Money::GBP(5.8800), $moneys['GBP']);
        $this->assertEquals(Money::ARS(0.4100), $moneys['ARS']);
        $this->assertEquals(Money::CLP(0.0062), $moneys['CLP']);
        $this->assertEquals(Money::MXN(0.2410), $moneys['MXN']);
    }

    public function testScrapeCurrencyCardForARRM()
    {
        $exchangeOffice = ExchangeOfficeConfig::get('arrm');
        $exchangeDocument = $this->client->generateDocument($exchangeOffice, ExchangeOfficeConfig::CURRENCY_CARD_PRODUCT);
        $moneys = $this->scraper->scrapeExchangeRates($exchangeDocument);

        $this->assertEquals(Money::USD(4.1389), $moneys['USD']);
        $this->assertEquals(Money::EUR(4.6155), $moneys['EUR']);
        $this->assertEquals(Money::GBP(6.2061), $moneys['GBP']);
    }

    public function testScrapeCurrenciesForGreen()
    {
        $exchangeOffice = ExchangeOfficeConfig::get('green');
        $exchangeDocument = $this->client->generateDocument($exchangeOffice, ExchangeOfficeConfig::FOREIGN_CURRENCY_PRODUCT);
        $moneys = $this->scraper->scrapeExchangeRates($exchangeDocument);

        $this->assertEquals(Money::USD(4.07), $moneys['USD']);
        $this->assertEquals(Money::EUR(4.45), $moneys['EUR']);
    }

    public function testScrapeCurrenciesForMaxima()
    {
        $exchangeOffice = ExchangeOfficeConfig::get('maxima');
        $exchangeDocument = $this->client->generateDocument($exchangeOffice, ExchangeOfficeConfig::FOREIGN_CURRENCY_PRODUCT);
        $moneys = $this->scraper->scrapeExchangeRates($exchangeDocument);

        $this->assertEquals(Money::USD(3.96), $moneys['USD']);
        $this->assertEquals(Money::EUR(4.35), $moneys['EUR']);
        $this->assertEquals(Money::GBP(5.68), $moneys['GBP']);
    }

    public function testScrapeCurrencyCardForMaxima()
    {
        $exchangeOffice = ExchangeOfficeConfig::get('maxima');
        $exchangeDocument = $this->client->generateDocument($exchangeOffice, ExchangeOfficeConfig::CURRENCY_CARD_PRODUCT);
        $moneys = $this->scraper->scrapeExchangeRates($exchangeDocument);

        $this->assertEquals(Money::USD(3.94), $moneys['USD']);
        $this->assertEquals(Money::AUD(3.02), $moneys['AUD']);
        $this->assertEquals(Money::EUR(4.33), $moneys['EUR']);
        $this->assertEquals(Money::CAD(3.05), $moneys['CAD']);
        $this->assertEquals(Money::GBP(5.63), $moneys['GBP']);
        $this->assertEquals(Money::ARS(0.27), $moneys['ARS']);
    }

    public function testScrapeCurrenciesForPicchioni()
    {
        $exchangeOffice = ExchangeOfficeConfig::get('picchioni');
        $exchangeDocument = $this->client->generateDocument($exchangeOffice, ExchangeOfficeConfig::FOREIGN_CURRENCY_PRODUCT);
        $moneys = $this->scraper->scrapeExchangeRates($exchangeDocument);

        $this->assertEquals(Money::USD(3.82000), $moneys['USD']);
        $this->assertEquals(Money::EUR(4.28000), $moneys['EUR']);
        $this->assertEquals(Money::CAD(2.99000), $moneys['CAD']);
        $this->assertEquals(Money::AUD(2.97000), $moneys['AUD']);
    }

    public function testScrapeCurrencyCardForPicchioni()
    {
        $exchangeOffice = ExchangeOfficeConfig::get('picchioni');
        $exchangeDocument = $this->client->generateDocument($exchangeOffice, ExchangeOfficeConfig::CURRENCY_CARD_PRODUCT);
        $moneys = $this->scraper->scrapeExchangeRates($exchangeDocument);

        $this->assertEquals(Money::USD(3.76000), $moneys['USD']);
        $this->assertEquals(Money::EUR(4.21000), $moneys['EUR']);
        $this->assertEquals(Money::GBP(5.60000), $moneys['GBP']);
    }

    public function testScrapeCurrenciesForForGraco()
    {
        $exchangeOffice = ExchangeOfficeConfig::get('graco');
        $exchangeDocument = $this->client->generateDocument($exchangeOffice, ExchangeOfficeConfig::FOREIGN_CURRENCY_PRODUCT);
        $moneys = $this->scraper->scrapeExchangeRates($exchangeDocument);

        $this->assertEquals(Money::USD(3.9700), $moneys['USD']);
        $this->assertEquals(Money::EUR(4.3400), $moneys['EUR']);
        $this->assertEquals(Money::GBP(5.7000), $moneys['GBP']);
        $this->assertEquals(Money::ARS(0.3000), $moneys['ARS']);
        $this->assertEquals(Money::JPY(0.0357), $moneys['JPY']);
        $this->assertEquals(Money::CAD(3.0100), $moneys['CAD']);
        $this->assertEquals(Money::AUD(2.9700), $moneys['AUD']);
        $this->assertEquals(Money::NZD(2.7200), $moneys['NZD']);
        $this->assertEquals(Money::CHF(4.0900), $moneys['CHF']);
        $this->assertEquals(Money::ILS(1.0900), $moneys['ILS']);
        $this->assertEquals(Money::CLP(0.0063), $moneys['CLP']);
        $this->assertEquals(Money::MXN(0.2300), $moneys['MXN']);
        $this->assertEquals(Money::UYU(0.1300), $moneys['UYU']);
        $this->assertEquals(Money::ZAR(0.3200), $moneys['ZAR']);
        $this->assertEquals(Money::CNY(0.7000), $moneys['CNY']);
    }

    public function testScrapeCurrencyCardForGraco()
    {
        $exchangeOffice = ExchangeOfficeConfig::get('graco');
        $exchangeDocument = $this->client->generateDocument($exchangeOffice, ExchangeOfficeConfig::CURRENCY_CARD_PRODUCT);
        $moneys = $this->scraper->scrapeExchangeRates($exchangeDocument);

        $this->assertEquals(Money::USD(3.9500), $moneys['USD']);
        $this->assertEquals(Money::EUR(4.3200), $moneys['EUR']);
        $this->assertEquals(Money::AUD(3.9600), $moneys['AUD']);
        $this->assertEquals(Money::CAD(3.0000), $moneys['CAD']);
        $this->assertEquals(Money::GBP(5.6900), $moneys['GBP']);
        $this->assertEquals(Money::ARS(0.2900), $moneys['ARS']);
    }

    public function testScrapeCurrenciesForCambioStore()
    {
        $exchangeOffice = ExchangeOfficeConfig::get('cambio-store');
        $exchangeDocument = $this->client->generateDocument($exchangeOffice, ExchangeOfficeConfig::FOREIGN_CURRENCY_PRODUCT);
        $moneys = $this->scraper->scrapeExchangeRates($exchangeDocument);

        $this->assertEquals(Money::USD(3.8700), $moneys['USD']);
        $this->assertEquals(Money::EUR(4.2900), $moneys['EUR']);
        $this->assertEquals(Money::GBP(5.6400), $moneys['GBP']);
        $this->assertEquals(Money::CAD(3.0100), $moneys['CAD']);
        $this->assertEquals(Money::AUD(3.0300), $moneys['AUD']);
        $this->assertEquals(Money::NZD(2.8700), $moneys['NZD']);
        $this->assertEquals(Money::ARS(0.2840), $moneys['ARS']);
        $this->assertEquals(Money::CLP(0.0062), $moneys['CLP']);
        $this->assertEquals(Money::MXN(0.2890), $moneys['MXN']);
        $this->assertEquals(Money::CHF(4.2100), $moneys['CHF']);
        $this->assertEquals(Money::JPY(0.0370), $moneys['JPY']);
        $this->assertEquals(Money::CNY(0.6840), $moneys['CNY']);
        $this->assertEquals(Money::COP(0.0016), $moneys['COP']);
        $this->assertEquals(Money::UYU(0.1550), $moneys['UYU']);
        $this->assertEquals(Money::ZAR(0.3320), $moneys['ZAR']);
        $this->assertEquals(Money::DKK(0.7530), $moneys['DKK']);
        $this->assertEquals(Money::NOK(0.6090), $moneys['NOK']);
        $this->assertEquals(Money::SEK(0.6100), $moneys['SEK']);
    }

    public function testScrapeCurrencyCardForCambioStore()
    {
        $exchangeOffice = ExchangeOfficeConfig::get('cambio-store');
        $exchangeDocument = $this->client->generateDocument($exchangeOffice, ExchangeOfficeConfig::CURRENCY_CARD_PRODUCT);
        $moneys = $this->scraper->scrapeExchangeRates($exchangeDocument);

        $this->assertEquals(Money::USD(4.1500), $moneys['USD']);
        $this->assertEquals(Money::EUR(4.5600), $moneys['EUR']);
        $this->assertEquals(Money::GBP(5.9800), $moneys['GBP']);
    }

    public function testScrapeForeingCurrencyForPrimeCash()
    {
        $exchangeOffice = ExchangeOfficeConfig::get('prime-cash');
        $exchangeDocument = $this->client->generateDocument($exchangeOffice, ExchangeOfficeConfig::FOREIGN_CURRENCY_PRODUCT);
        $moneys = $this->scraper->scrapeExchangeRates($exchangeDocument);

        $this->assertEquals(Money::USD(4.10), $moneys['USD']);
        $this->assertEquals(Money::EUR(4.48), $moneys['EUR']);
        $this->assertEquals(Money::GBP(5.86), $moneys['GBP']);
        $this->assertEquals(Money::ARS(0.31), $moneys['ARS']);
        $this->assertEquals(Money::CAD(3.14), $moneys['CAD']);
        $this->assertEquals(Money::AUD(3.10), $moneys['AUD']);
        $this->assertEquals(Money::NZD(2.93), $moneys['NZD']);
        $this->assertEquals(Money::CLP(0.0066), $moneys['CLP']);
        $this->assertEquals(Money::MXN(0.2540), $moneys['MXN']);
        $this->assertEquals(Money::UYU(0.1410), $moneys['UYU']);
        $this->assertEquals(Money::CHF(4.27), $moneys['CHF']);
        $this->assertEquals(Money::JPY(0.0390), $moneys['JPY']);
        $this->assertEquals(Money::CNY(0.70), $moneys['CNY']);
    }

    public function testScrapeCurrencyCardForPrimeCash()
    {
        $exchangeOffice = ExchangeOfficeConfig::get('prime-cash');
        $exchangeDocument = $this->client->generateDocument($exchangeOffice, ExchangeOfficeConfig::CURRENCY_CARD_PRODUCT);
        $moneys = $this->scraper->scrapeExchangeRates($exchangeDocument);

        $this->assertEquals(Money::USD(4.10), $moneys['USD']);
        $this->assertEquals(Money::EUR(4.48), $moneys['EUR']);
        $this->assertEquals(Money::GBP(5.86), $moneys['GBP']);
        $this->assertEquals(Money::CAD(3.14), $moneys['CAD']);
        $this->assertEquals(Money::AUD(3.10), $moneys['AUD']);
    }

    public function testScrapeCurrenciesForFastMoney()
    {
        $exchangeOffice = ExchangeOfficeConfig::get('fast-money');
        $exchangeDocument = $this->client->generateDocument($exchangeOffice, ExchangeOfficeConfig::FOREIGN_CURRENCY_PRODUCT);
        $moneys = $this->scraper->scrapeExchangeRates($exchangeDocument);

        $this->assertEquals(Money::USD(4.11), $moneys['USD']);
        $this->assertEquals(Money::AUD(3.05), $moneys['AUD']);
        $this->assertEquals(Money::CAD(3.16), $moneys['CAD']);
        $this->assertEquals(Money::EUR(4.52), $moneys['EUR']);
        $this->assertEquals(Money::CHF(4.41), $moneys['CHF']);
        $this->assertEquals(Money::GBP(5.89), $moneys['GBP']);
        $this->assertEquals(Money::CLP(0.0065), $moneys['CLP']);
        $this->assertEquals(Money::MXN(0.25), $moneys['MXN']);
        $this->assertEquals(Money::UYU(0.18), $moneys['UYU']);
    }

    public function testScrapeCurrenciesForFoxCambio()
    {
        $exchangeOffice = ExchangeOfficeConfig::get('fox-cambio');
        $exchangeDocument = $this->client->generateDocument($exchangeOffice, ExchangeOfficeConfig::FOREIGN_CURRENCY_PRODUCT);
        $moneys = $this->scraper->scrapeExchangeRates($exchangeDocument);

        $this->assertEquals(Money::USD(3.4197), $moneys['USD']);
        $this->assertEquals(Money::EUR(3.8115), $moneys['EUR']);
        $this->assertEquals(Money::GBP(4.5697), $moneys['GBP']);
        $this->assertEquals(Money::AUD(2.6994), $moneys['AUD']);
        $this->assertEquals(Money::CAD(2.7196), $moneys['CAD']);
        $this->assertEquals(Money::NZD(2.5882), $moneys['NZD']);
        $this->assertEquals(Money::CHF(3.6800), $moneys['CHF']);
        $this->assertEquals(Money::JPY(0.0372), $moneys['JPY']);
        $this->assertEquals(Money::CNY(0.5662), $moneys['CNY']);
        $this->assertEquals(Money::ARS(0.3033), $moneys['ARS']);
        $this->assertEquals(Money::CLP(0.0058), $moneys['CLP']);
        $this->assertEquals(Money::COP(0.0013), $moneys['COP']);
        $this->assertEquals(Money::MXN(0.2022), $moneys['MXN']);
        $this->assertEquals(Money::UYU(0.1213), $moneys['UYU']);
        $this->assertEquals(Money::ZAR(0.2730), $moneys['ZAR']);
        $this->assertEquals(Money::ILS(0.9908), $moneys['ILS']);
    }

    public function testScrapeCurrencyCardForFoxCambio()
    {
        $exchangeOffice = ExchangeOfficeConfig::get('fox-cambio');
        $exchangeDocument = $this->client->generateDocument($exchangeOffice, ExchangeOfficeConfig::CURRENCY_CARD_PRODUCT);
        $moneys = $this->scraper->scrapeExchangeRates($exchangeDocument);

        $this->assertEquals(Money::USD(3.5850), $moneys['USD']);
        $this->assertEquals(Money::EUR(3.9893), $moneys['EUR']);
        $this->assertEquals(Money::GBP(4.6807), $moneys['GBP']);
    }

    public function testScrapeCurrenciesForGoldenMoney()
    {
        $exchangeOffice = ExchangeOfficeConfig::get('golden-money');
        $exchangeDocument = $this->client->generateDocument($exchangeOffice, ExchangeOfficeConfig::FOREIGN_CURRENCY_PRODUCT);
        $moneys = $this->scraper->scrapeExchangeRates($exchangeDocument);

        $this->assertEquals(Money::USD(4.18), $moneys['USD']);
        $this->assertEquals(Money::EUR(4.54), $moneys['EUR']);
        $this->assertEquals(Money::GBP(6.08), $moneys['GBP']);
    }

    public function testScrapeCurrenciesForConexion()
    {
        $exchangeOffice = ExchangeOfficeConfig::get('conexion');
        $exchangeDocument = $this->client->generateDocument($exchangeOffice, ExchangeOfficeConfig::FOREIGN_CURRENCY_PRODUCT);
        $moneys = $this->scraper->scrapeExchangeRates($exchangeDocument);

        $this->assertEquals(Money::USD(4.18), $moneys['USD']);
        $this->assertEquals(Money::EUR(4.56), $moneys['EUR']);
        $this->assertEquals(Money::GBP(6.08), $moneys['GBP']);
    }

    public function testScrapeCurrenciesForCasaAlianca()
    {
        $exchangeOffice = ExchangeOfficeConfig::get('casa-alianca');
        $exchangeDocument = $this->client->generateDocument($exchangeOffice, ExchangeOfficeConfig::FOREIGN_CURRENCY_PRODUCT);
        $moneys = $this->scraper->scrapeExchangeRates($exchangeDocument);

        $this->assertEquals(Money::USD(4.13), $moneys['USD']);
        $this->assertEquals(Money::EUR(4.54), $moneys['EUR']);
        $this->assertEquals(Money::GBP(5.87), $moneys['GBP']);
        $this->assertEquals(Money::ARS(0.30), $moneys['ARS']);
        $this->assertEquals(Money::AUD(3.06), $moneys['AUD']);
        $this->assertEquals(Money::CAD(3.08), $moneys['CAD']);
        $this->assertEquals(Money::CLP(0.0067), $moneys['CLP']);
        $this->assertEquals(Money::JPY(0.042), $moneys['JPY']);
        $this->assertEquals(Money::CHF(4.29), $moneys['CHF']);
    }

    public function testScrapeCururrencyCardForCasaAlianca()
    {
        $exchangeOffice = ExchangeOfficeConfig::get('casa-alianca');
        $exchangeDocument = $this->client->generateDocument($exchangeOffice, ExchangeOfficeConfig::CURRENCY_CARD_PRODUCT);
        $moneys = $this->scraper->scrapeExchangeRates($exchangeDocument);

        $this->assertEquals(Money::USD(4.37), $moneys['USD']);
        $this->assertEquals(Money::EUR(4.80), $moneys['EUR']);
        $this->assertEquals(Money::GBP(6.13), $moneys['GBP']);
    }

    public function testScrapeCurrenciesForPremiumViagens()
    {
        $exchangeOffice = ExchangeOfficeConfig::get('premium-viagens');
        $exchangeDocument = $this->client->generateDocument($exchangeOffice, ExchangeOfficeConfig::FOREIGN_CURRENCY_PRODUCT);
        $moneys = $this->scraper->scrapeExchangeRates($exchangeDocument);

        $this->assertEquals(Money::USD(4.14), $moneys['USD']);
        $this->assertEquals(Money::EUR(4.55), $moneys['EUR']);
        $this->assertEquals(Money::GBP(5.95), $moneys['GBP']);
        $this->assertEquals(Money::ARS(0.30), $moneys['ARS']);
        $this->assertEquals(Money::AUD(3.08), $moneys['AUD']);
        $this->assertEquals(Money::CAD(3.12), $moneys['CAD']);
        $this->assertEquals(Money::CLP(0.0068), $moneys['CLP']);
        $this->assertEquals(Money::JPY(0.041), $moneys['JPY']);
        $this->assertEquals(Money::CHF(4.26), $moneys['CHF']);
    }

    public function testScrapeCururrencyCardForPremiumViagens()
    {
        $exchangeOffice = ExchangeOfficeConfig::get('premium-viagens');
        $exchangeDocument = $this->client->generateDocument($exchangeOffice, ExchangeOfficeConfig::CURRENCY_CARD_PRODUCT);
        $moneys = $this->scraper->scrapeExchangeRates($exchangeDocument);

        $this->assertEquals(Money::USD(4.38), $moneys['USD']);
        $this->assertEquals(Money::EUR(4.82), $moneys['EUR']);
        $this->assertEquals(Money::GBP(6.18), $moneys['GBP']);
    }

    public function testScrapeCurrenciesForTempoLivre()
    {
        $exchangeOffice = ExchangeOfficeConfig::get('tempo-livre');
        $exchangeDocument = $this->client->generateDocument($exchangeOffice, ExchangeOfficeConfig::FOREIGN_CURRENCY_PRODUCT);
        $moneys = $this->scraper->scrapeExchangeRates($exchangeDocument);

        $this->assertEquals(Money::USD(4.12), $moneys['USD']);
        $this->assertEquals(Money::EUR(4.58), $moneys['EUR']);
        $this->assertEquals(Money::CLP(0.0075), $moneys['CLP']);
        $this->assertEquals(Money::ARS(0.40), $moneys['ARS']);
        $this->assertEquals(Money::AUD(3.10), $moneys['AUD']);
        $this->assertEquals(Money::CAD(3.10), $moneys['CAD']);
        $this->assertEquals(Money::GBP(6.00), $moneys['GBP']);
        $this->assertEquals(Money::JPY(0.045), $moneys['JPY']);
        $this->assertEquals(Money::CHF(4.40), $moneys['CHF']);
    }

    public function testScrapeCururrencyCardForTempoLivre()
    {
        $exchangeOffice = ExchangeOfficeConfig::get('tempo-livre');
        $exchangeDocument = $this->client->generateDocument($exchangeOffice, ExchangeOfficeConfig::CURRENCY_CARD_PRODUCT);
        $moneys = $this->scraper->scrapeExchangeRates($exchangeDocument);

        $this->assertEquals(Money::USD(4.12), $moneys['USD']);
        $this->assertEquals(Money::EUR(4.58), $moneys['EUR']);
        $this->assertEquals(Money::GBP(6.00), $moneys['GBP']);
        $this->assertEquals(Money::CAD(3.10), $moneys['CAD']);
        $this->assertEquals(Money::AUD(3.10), $moneys['AUD']);
        $this->assertEquals(Money::ARS(0.40), $moneys['ARS']);
    }

    public function testScrapeCurrenciesForAmitur()
    {
        $exchangeOffice = ExchangeOfficeConfig::get('amitur');
        $exchangeDocument = $this->client->generateDocument($exchangeOffice, ExchangeOfficeConfig::FOREIGN_CURRENCY_PRODUCT);
        $moneys = $this->scraper->scrapeExchangeRates($exchangeDocument);

        $this->assertEquals(Money::USD(4.08), $moneys['USD']);
        $this->assertEquals(Money::EUR(4.49), $moneys['EUR']);
        $this->assertEquals(Money::GBP(5.80), $moneys['GBP']);
        $this->assertEquals(Money::ARS(0.30), $moneys['ARS']);
        $this->assertEquals(Money::AUD(3.03), $moneys['AUD']);
        $this->assertEquals(Money::CAD(3.09), $moneys['CAD']);
        $this->assertEquals(Money::CLP(0.0067), $moneys['CLP']);
        $this->assertEquals(Money::JPY(0.041), $moneys['JPY']);
        $this->assertEquals(Money::CHF(4.23), $moneys['CHF']);
    }

    public function testScrapeCururrencyCardForAmitur()
    {
        $exchangeOffice = ExchangeOfficeConfig::get('amitur');
        $exchangeDocument = $this->client->generateDocument($exchangeOffice, ExchangeOfficeConfig::CURRENCY_CARD_PRODUCT);
        $moneys = $this->scraper->scrapeExchangeRates($exchangeDocument);

        $this->assertEquals(Money::USD(4.30), $moneys['USD']);
        $this->assertEquals(Money::EUR(4.74), $moneys['EUR']);
        $this->assertEquals(Money::GBP(6.06), $moneys['GBP']);
    }

    public function testScrapeCurrenciesForOneBarra()
    {
        $exchangeOffice = ExchangeOfficeConfig::get('one-barra');
        $exchangeDocument = $this->client->generateDocument($exchangeOffice, ExchangeOfficeConfig::FOREIGN_CURRENCY_PRODUCT);
        $moneys = $this->scraper->scrapeExchangeRates($exchangeDocument);

        $this->assertEquals(Money::USD(4.06335), $moneys['USD']);
        $this->assertEquals(Money::EUR(4.51188), $moneys['EUR']);
        $this->assertEquals(Money::GBP(5.86229), $moneys['GBP']);
        $this->assertEquals(Money::CAD(3.12589), $moneys['CAD']);
        $this->assertEquals(Money::AUD(3.05967), $moneys['AUD']);
        $this->assertEquals(Money::CLP(0.00630), $moneys['CLP']);
        $this->assertEquals(Money::CHF(4.24259), $moneys['CHF']);
    }

    public function testScrapeCurrenciesForDantur()
    {
        $exchangeOffice = ExchangeOfficeConfig::get('dantur');
        $exchangeDocument = $this->client->generateDocument($exchangeOffice, ExchangeOfficeConfig::FOREIGN_CURRENCY_PRODUCT);
        $moneys = $this->scraper->scrapeExchangeRates($exchangeDocument);

        $this->assertEquals(Money::USD(4.10), $moneys['USD']);
        $this->assertEquals(Money::EUR(4.55), $moneys['EUR']);
        $this->assertEquals(Money::GBP(6.15), $moneys['GBP']);
        $this->assertEquals(Money::CAD(3.15), $moneys['CAD']);
        $this->assertEquals(Money::AUD(3.14), $moneys['AUD']);
        $this->assertEquals(Money::ARS(0.35), $moneys['ARS']);
        $this->assertEquals(Money::CHF(4.20), $moneys['CHF']);
        $this->assertEquals(Money::CLP(0.0062), $moneys['CLP']);
    }

    public function testScrapeCururrencyCardForDantur()
    {
        $exchangeOffice = ExchangeOfficeConfig::get('dantur');
        $exchangeDocument = $this->client->generateDocument($exchangeOffice, ExchangeOfficeConfig::CURRENCY_CARD_PRODUCT);
        $moneys = $this->scraper->scrapeExchangeRates($exchangeDocument);

        $this->assertEquals(Money::USD(4.10), $moneys['USD']);
        $this->assertEquals(Money::EUR(4.55), $moneys['EUR']);
        $this->assertEquals(Money::GBP(6.15), $moneys['GBP']);
        $this->assertEquals(Money::CAD(3.15), $moneys['CAD']);
        $this->assertEquals(Money::AUD(3.14), $moneys['AUD']);
    }

    public function testScrapeCurrenciesQuatroCantos()
    {
        $exchangeOffice = ExchangeOfficeConfig::get('quatro-cantos');
        $exchangeDocument = $this->client->generateDocument($exchangeOffice, ExchangeOfficeConfig::FOREIGN_CURRENCY_PRODUCT);
        $moneys = $this->scraper->scrapeExchangeRates($exchangeDocument);

        $this->assertEquals(Money::USD(4.0700), $moneys['USD']);
        $this->assertEquals(Money::EUR(4.4800), $moneys['EUR']);
        $this->assertEquals(Money::GBP(5.8700), $moneys['GBP']);
        $this->assertEquals(Money::ARS(0.3000), $moneys['ARS']);
        $this->assertEquals(Money::CHF(4.2100), $moneys['CHF']);
        $this->assertEquals(Money::AUD(3.0900), $moneys['AUD']);
        $this->assertEquals(Money::CLP(0.0068), $moneys['CLP']);
        $this->assertEquals(Money::CAD(3.1400), $moneys['CAD']);
        $this->assertEquals(Money::JPY(0.0500), $moneys['JPY']);
    }

    public function testScrapeCurrenciesIpanemaExchange()
    {
        $exchangeOffice = ExchangeOfficeConfig::get('ipanema-exchange');
        $exchangeDocument = $this->client->generateDocument($exchangeOffice, ExchangeOfficeConfig::FOREIGN_CURRENCY_PRODUCT);
        $moneys = $this->scraper->scrapeExchangeRates($exchangeDocument);

        $this->assertEquals(Money::USD(4.09), $moneys['USD']);
        $this->assertEquals(Money::CAD(3.09), $moneys['CAD']);
        $this->assertEquals(Money::EUR(4.49), $moneys['EUR']);
        $this->assertEquals(Money::GBP(5.99), $moneys['GBP']);
        $this->assertEquals(Money::AUD(3.07), $moneys['AUD']);
        $this->assertEquals(Money::ARS(0.28), $moneys['ARS']);
        $this->assertEquals(Money::CHF(4.05), $moneys['CHF']);
    }

    public function testScrapeCurrenciesForUltramar()
    {
        $exchangeOffice = ExchangeOfficeConfig::get('ultramar');
        $exchangeDocument = $this->client->generateDocument($exchangeOffice, ExchangeOfficeConfig::FOREIGN_CURRENCY_PRODUCT);
        $moneys = $this->scraper->scrapeExchangeRates($exchangeDocument);

        $this->assertEquals(Money::USD(4.15), $moneys['USD']);
        $this->assertEquals(Money::EUR(4.54), $moneys['EUR']);
        $this->assertEquals(Money::GBP(5.90), $moneys['GBP']);
        $this->assertEquals(Money::CAD(3.13), $moneys['CAD']);
        $this->assertEquals(Money::AUD(3.09), $moneys['AUD']);
        $this->assertEquals(Money::CHF(4.28), $moneys['CHF']);
        $this->assertEquals(Money::JPY(0.042), $moneys['JPY']);
        $this->assertEquals(Money::ARS(0.35), $moneys['ARS']);
        $this->assertEquals(Money::CLP(0.0067), $moneys['CLP']);
    }

    public function testScrapeCururrencyCardForUltramar()
    {
        $exchangeOffice = ExchangeOfficeConfig::get('ultramar');
        $exchangeDocument = $this->client->generateDocument($exchangeOffice, ExchangeOfficeConfig::CURRENCY_CARD_PRODUCT);
        $moneys = $this->scraper->scrapeExchangeRates($exchangeDocument);

        $this->assertEquals(Money::USD(4.41), $moneys['USD']);
        $this->assertEquals(Money::EUR(4.83), $moneys['EUR']);
        $this->assertEquals(Money::GBP(6.25), $moneys['GBP']);
    }

    public function testScrapeCurrenciesForLeBonVoyage()
    {
        $exchangeOffice = ExchangeOfficeConfig::get('le-bon-voyage');
        $exchangeDocument = $this->client->generateDocument($exchangeOffice, ExchangeOfficeConfig::FOREIGN_CURRENCY_PRODUCT);
        $moneys = $this->scraper->scrapeExchangeRates($exchangeDocument);

        $this->assertEquals(Money::USD(3.68), $moneys['USD']);
        $this->assertEquals(Money::EUR(4.19), $moneys['EUR']);
        $this->assertEquals(Money::AUD(3.09), $moneys['AUD']);
        $this->assertEquals(Money::CAD(3.18), $moneys['CAD']);
        $this->assertEquals(Money::NZD(3.02), $moneys['NZD']);
        $this->assertEquals(Money::CHF(4.06), $moneys['CHF']);
        $this->assertEquals(Money::GBP(5.83), $moneys['GBP']);
        $this->assertEquals(Money::MXN(0.36), $moneys['MXN']);
        $this->assertEquals(Money::ARS(0.33), $moneys['ARS']);
        $this->assertEquals(Money::CLP(0.0068), $moneys['CLP']);
        $this->assertEquals(Money::UYU(0.29), $moneys['UYU']);
        $this->assertEquals(Money::JPY(0.0412), $moneys['JPY']);
        $this->assertEquals(Money::CNY(0.86), $moneys['CNY']);
        $this->assertEquals(Money::ZAR(0.40), $moneys['ZAR']);
        $this->assertEquals(Money::DKK(0.77), $moneys['DKK']);
        $this->assertEquals(Money::SEK(0.62), $moneys['SEK']);
        $this->assertEquals(Money::PEN(1.40), $moneys['PEN']);
        $this->assertEquals(Money::NOK(0.61), $moneys['NOK']);

    }

    public function testScrapeCurrenciesPmTurismo()
    {
        $exchangeOffice = ExchangeOfficeConfig::get('pm-turismo');
        $exchangeDocument = $this->client->generateDocument($exchangeOffice, ExchangeOfficeConfig::FOREIGN_CURRENCY_PRODUCT);
        $moneys = $this->scraper->scrapeExchangeRates($exchangeDocument);

        $this->assertEquals(Money::USD(3.62), $moneys['USD']);
        $this->assertEquals(Money::EUR(4.12), $moneys['EUR']);
        $this->assertEquals(Money::GBP(5.35), $moneys['GBP']);
        $this->assertEquals(Money::ARS(0.28), $moneys['ARS']);
    }

    public function testScrapeCurrenciesNavegantes()
    {
        $exchangeOffice = ExchangeOfficeConfig::get('navegantes');
        $exchangeDocument = $this->client->generateDocument($exchangeOffice, ExchangeOfficeConfig::FOREIGN_CURRENCY_PRODUCT);
        $moneys = $this->scraper->scrapeExchangeRates($exchangeDocument);

        $this->assertEquals(Money::USD(4.13), $moneys['USD']);
        $this->assertEquals(Money::EUR(4.51), $moneys['EUR']);
        $this->assertEquals(Money::ARS(0.30), $moneys['ARS']);
        $this->assertEquals(Money::CLP(0.0064), $moneys['CLP']);
        $this->assertEquals(Money::CHF(4.25), $moneys['CHF']);
        $this->assertEquals(Money::CAD(3.10), $moneys['CAD']);
        $this->assertEquals(Money::GBP(5.85), $moneys['GBP']);
        $this->assertEquals(Money::AUD(3.05), $moneys['AUD']);
        $this->assertEquals(Money::JPY(0.042), $moneys['JPY']);
    }

    public function testScrapeCururrencyCardForNavegantes()
    {
        $exchangeOffice = ExchangeOfficeConfig::get('navegantes');
        $exchangeDocument = $this->client->generateDocument($exchangeOffice, ExchangeOfficeConfig::CURRENCY_CARD_PRODUCT);
        $moneys = $this->scraper->scrapeExchangeRates($exchangeDocument);

        $this->assertEquals(Money::USD(4.35), $moneys['USD']);
        $this->assertEquals(Money::EUR(4.72), $moneys['EUR']);
        $this->assertEquals(Money::CAD(3.28), $moneys['CAD']);
        $this->assertEquals(Money::GBP(6.10), $moneys['GBP']);
        $this->assertEquals(Money::AUD(3.28), $moneys['AUD']);
    }

    public function testScrapeCurrenciesForExpressChange()
    {
        $exchangeOffice = ExchangeOfficeConfig::get('express-change');
        $exchangeDocument = $this->client->generateDocument($exchangeOffice, ExchangeOfficeConfig::FOREIGN_CURRENCY_PRODUCT);
        $moneys = $this->scraper->scrapeExchangeRates($exchangeDocument);

        $this->assertEquals(Money::USD(3.69), $moneys['USD']);
        $this->assertEquals(Money::EUR(4.20), $moneys['EUR']);
        $this->assertEquals(Money::GBP(5.26), $moneys['GBP']);
        $this->assertEquals(Money::CAD(2.94), $moneys['CAD']);
        $this->assertEquals(Money::AUD(2.80), $moneys['AUD']);
        $this->assertEquals(Money::ARS(0.35), $moneys['ARS']);
        $this->assertEquals(Money::CHF(3.90), $moneys['CHF']);
        $this->assertEquals(Money::MXN(0.35), $moneys['MXN']);
        $this->assertEquals(Money::CLP(0.0070), $moneys['CLP']);
        $this->assertEquals(Money::BOB(0.65), $moneys['BOB']);
        $this->assertEquals(Money::PEN(1.30), $moneys['PEN']);
        $this->assertEquals(Money::UYU(0.17), $moneys['UYU']);
        $this->assertEquals(Money::JPY(0.035), $moneys['JPY']);
        $this->assertEquals(Money::CNY(2.94), $moneys['CNY']);
        $this->assertEquals(Money::NZD(2.66), $moneys['NZD']);
    }

    public function testScrapeCururrencyCardForExpressChange()
    {
        $exchangeOffice = ExchangeOfficeConfig::get('express-change');
        $exchangeDocument = $this->client->generateDocument($exchangeOffice, ExchangeOfficeConfig::CURRENCY_CARD_PRODUCT);
        $moneys = $this->scraper->scrapeExchangeRates($exchangeDocument);

        $this->assertEquals(Money::USD(3.66), $moneys['USD']);
        $this->assertEquals(Money::EUR(4.17), $moneys['EUR']);
        $this->assertEquals(Money::GBP(5.35), $moneys['GBP']);
        $this->assertEquals(Money::CAD(2.86), $moneys['CAD']);
    }

    public function testScrapeCururrencyCardForLygtur()
    {
        $exchangeOffice = ExchangeOfficeConfig::get('lygtur');
        $exchangeDocument = $this->client->generateDocument($exchangeOffice, ExchangeOfficeConfig::CURRENCY_CARD_PRODUCT);
        $moneys = $this->scraper->scrapeExchangeRates($exchangeDocument);

        $this->assertEquals(Money::AUD(2.98), $moneys['AUD']);
        $this->assertEquals(Money::EUR(4.25), $moneys['EUR']);
        $this->assertEquals(Money::CAD(2.98), $moneys['CAD']);
        $this->assertEquals(Money::GBP(5.59), $moneys['GBP']);
        $this->assertEquals(Money::USD(3.84), $moneys['USD']);
        $this->assertEquals(Money::ARS(0.35), $moneys['ARS']);
    }

    public function testScrapeCurrenciesForDg()
    {
        $exchangeOffice = ExchangeOfficeConfig::get('dg');
        $exchangeDocument = $this->client->generateDocument($exchangeOffice, ExchangeOfficeConfig::FOREIGN_CURRENCY_PRODUCT);
        $moneys = $this->scraper->scrapeExchangeRates($exchangeDocument);

        $this->assertEquals(Money::USD(4.1000), $moneys['USD']);
        $this->assertEquals(Money::EUR(4.5000), $moneys['EUR']);
        $this->assertEquals(Money::GBP(5.8500), $moneys['GBP']);
        $this->assertEquals(Money::ARS(0.4000), $moneys['ARS']);
        $this->assertEquals(Money::JPY(0.0403), $moneys['JPY']);
        $this->assertEquals(Money::CAD(3.1300), $moneys['CAD']);
        $this->assertEquals(Money::AUD(3.0200), $moneys['AUD']);
        $this->assertEquals(Money::NZD(2.8500), $moneys['NZD']);
        $this->assertEquals(Money::CHF(4.3000), $moneys['CHF']);
        $this->assertEquals(Money::CLP(0.0062), $moneys['CLP']);
        $this->assertEquals(Money::UYU(0.2500), $moneys['UYU']);
        $this->assertEquals(Money::CNY(0.8100), $moneys['CNY']);
        $this->assertEquals(Money::MXN(0.4800), $moneys['MXN']);
        $this->assertEquals(Money::ZAR(0.5000), $moneys['ZAR']);
    }

    public function testScrapeCururrencyCardForDg()
    {
        $exchangeOffice = ExchangeOfficeConfig::get('dg');
        $exchangeDocument = $this->client->generateDocument($exchangeOffice, ExchangeOfficeConfig::CURRENCY_CARD_PRODUCT);
        $moneys = $this->scraper->scrapeExchangeRates($exchangeDocument);

        $this->assertEquals(Money::USD(3.8500), $moneys['USD']);
        $this->assertEquals(Money::EUR(4.2500), $moneys['EUR']);
        $this->assertEquals(Money::AUD(2.9800), $moneys['AUD']);
        $this->assertEquals(Money::CAD(3.0000), $moneys['CAD']);
        $this->assertEquals(Money::GBP(5.6000), $moneys['GBP']);
    }

    public function testScrapeCurrenciesForEcoForte()
    {
        $exchangeOffice = ExchangeOfficeConfig::get('ecoforte');
        $exchangeDocument = $this->client->generateDocument($exchangeOffice, ExchangeOfficeConfig::FOREIGN_CURRENCY_PRODUCT);
        $moneys = $this->scraper->scrapeExchangeRates($exchangeDocument);

        $this->assertEquals(Money::USD(4.08), $moneys['USD']);
        $this->assertEquals(Money::AUD(3.02), $moneys['AUD']);
        $this->assertEquals(Money::CAD(3.12), $moneys['CAD']);
        $this->assertEquals(Money::NZD(2.86), $moneys['NZD']);
        $this->assertEquals(Money::EUR(4.45), $moneys['EUR']);
        $this->assertEquals(Money::CHF(4.24), $moneys['CHF']);
        $this->assertEquals(Money::GBP(5.85), $moneys['GBP']);
        $this->assertEquals(Money::ARS(0.33), $moneys['ARS']);
        $this->assertEquals(Money::MXN(0.29), $moneys['MXN']);
        $this->assertEquals(Money::CNY(0.72), $moneys['CNY']);
    }

    public function testScrapeCururrencyCardForEcoForte()
    {
        $exchangeOffice = ExchangeOfficeConfig::get('ecoforte');
        $exchangeDocument = $this->client->generateDocument($exchangeOffice, ExchangeOfficeConfig::CURRENCY_CARD_PRODUCT);
        $moneys = $this->scraper->scrapeExchangeRates($exchangeDocument);

        $this->assertEquals(Money::USD(4.34), $moneys['USD']);
        $this->assertEquals(Money::AUD(3.17), $moneys['AUD']);
        $this->assertEquals(Money::CAD(3.30), $moneys['CAD']);
        $this->assertEquals(Money::NZD(2.97), $moneys['NZD']);
        $this->assertEquals(Money::EUR(4.71), $moneys['EUR']);
        $this->assertEquals(Money::GBP(6.14), $moneys['GBP']);
    }

    public function testScrapeCurrenciesForMondialMoney()
    {
        $exchangeOffice = ExchangeOfficeConfig::get('mondial-money');
        $exchangeDocument = $this->client->generateDocument($exchangeOffice, ExchangeOfficeConfig::FOREIGN_CURRENCY_PRODUCT);
        $moneys = $this->scraper->scrapeExchangeRates($exchangeDocument);

        $this->assertEquals(Money::USD(3.9400), $moneys['USD']);
        $this->assertEquals(Money::AUD(3.0100), $moneys['AUD']);
        $this->assertEquals(Money::CAD(3.0400), $moneys['CAD']);
        $this->assertEquals(Money::NZD(2.9000), $moneys['NZD']);
        $this->assertEquals(Money::EUR(4.3400), $moneys['EUR']);
        $this->assertEquals(Money::CHF(4.2200), $moneys['CHF']);
        $this->assertEquals(Money::JPY(0.0382), $moneys['JPY']);
        $this->assertEquals(Money::GBP(5.7400), $moneys['GBP']);
        $this->assertEquals(Money::ARS(0.3200), $moneys['ARS']);
        $this->assertEquals(Money::CLP(0.0064), $moneys['CLP']);
        $this->assertEquals(Money::MXN(0.2560), $moneys['MXN']);
        $this->assertEquals(Money::UYU(0.1450), $moneys['UYU']);
        $this->assertEquals(Money::ZAR(0.3400), $moneys['ZAR']);
        $this->assertEquals(Money::CNY(0.7100), $moneys['CNY']);
    }

    public function testScrapeCururrencyCardForMondialMoney()
    {
        $exchangeOffice = ExchangeOfficeConfig::get('mondial-money');
        $exchangeDocument = $this->client->generateDocument($exchangeOffice, ExchangeOfficeConfig::CURRENCY_CARD_PRODUCT);
        $moneys = $this->scraper->scrapeExchangeRates($exchangeDocument);

        $this->assertEquals(Money::USD(4.1914), $moneys['USD']);
        $this->assertEquals(Money::EUR(4.6169), $moneys['EUR']);
        $this->assertEquals(Money::GBP(6.1062), $moneys['GBP']);
    }

    public function testScrapeCurrenciesForGuitta()
    {
        $exchangeOffice = ExchangeOfficeConfig::get('guitta');
        $exchangeDocument = $this->client->generateDocument($exchangeOffice, ExchangeOfficeConfig::FOREIGN_CURRENCY_PRODUCT);
        $moneys = $this->scraper->scrapeExchangeRates($exchangeDocument);

        $this->assertEquals(Money::USD(3.98), $moneys['USD']);
        $this->assertEquals(Money::EUR(4.38), $moneys['EUR']);
    }

    public function testScrapeCururrencyCardForGuitta()
    {
        $exchangeOffice = ExchangeOfficeConfig::get('guitta');
        $exchangeDocument = $this->client->generateDocument($exchangeOffice, ExchangeOfficeConfig::CURRENCY_CARD_PRODUCT);
        $moneys = $this->scraper->scrapeExchangeRates($exchangeDocument);

        $this->assertEquals(Money::USD(3.94), $moneys['USD']);
        $this->assertEquals(Money::EUR(4.33), $moneys['EUR']);
    }

    public function testScrapeCurrenciesForDS()
    {
        $exchangeOffice = ExchangeOfficeConfig::get('ds');
        $exchangeDocument = $this->client->generateDocument($exchangeOffice, ExchangeOfficeConfig::FOREIGN_CURRENCY_PRODUCT);
        $moneys = $this->scraper->scrapeExchangeRates($exchangeDocument);

        $this->assertEquals(Money::USD(3.94), $moneys['USD']);
        $this->assertEquals(Money::EUR(4.35), $moneys['EUR']);
        $this->assertEquals(Money::GBP(5.69), $moneys['GBP']);
        $this->assertEquals(Money::CAD(3.06), $moneys['CAD']);
        $this->assertEquals(Money::AUD(3.06), $moneys['AUD']);
    }

    public function testScrapeCururrencyCardForDS()
    {
        $exchangeOffice = ExchangeOfficeConfig::get('ds');
        $exchangeDocument = $this->client->generateDocument($exchangeOffice, ExchangeOfficeConfig::CURRENCY_CARD_PRODUCT);
        $moneys = $this->scraper->scrapeExchangeRates($exchangeDocument);

        $this->assertEquals(Money::USD(3.90), $moneys['USD']);
        $this->assertEquals(Money::EUR(4.30), $moneys['EUR']);
        $this->assertEquals(Money::GBP(5.63), $moneys['GBP']);
        $this->assertEquals(Money::CAD(3.03), $moneys['CAD']);
        $this->assertEquals(Money::AUD(3.03), $moneys['AUD']);
    }

    public function testScrapeCurrenciesForSita()
    {
        $exchangeOffice = ExchangeOfficeConfig::get('sita');
        $exchangeDocument = $this->client->generateDocument($exchangeOffice, ExchangeOfficeConfig::FOREIGN_CURRENCY_PRODUCT);
        $moneys = $this->scraper->scrapeExchangeRates($exchangeDocument);

        $this->assertEquals(Money::USD(3.79), $moneys['USD']);
    }

    public function testScrapeCurrenciesForThaler()
    {
        $exchangeOffice = ExchangeOfficeConfig::get('thaler');
        $exchangeDocument = $this->client->generateDocument($exchangeOffice, ExchangeOfficeConfig::FOREIGN_CURRENCY_PRODUCT);
        $moneys = $this->scraper->scrapeExchangeRates($exchangeDocument);

        $this->assertEquals(Money::USD(3.83), $moneys['USD']);
        $this->assertEquals(Money::EUR(4.26), $moneys['EUR']);
        $this->assertEquals(Money::GBP(5.60), $moneys['GBP']);
        $this->assertEquals(Money::CHF(3.97), $moneys['CHF']);
    }

    public function testScrapeCurrenciesForEuropa()
    {
        $exchangeOffice = ExchangeOfficeConfig::get('europa');
        $exchangeDocument = $this->client->generateDocument($exchangeOffice, ExchangeOfficeConfig::FOREIGN_CURRENCY_PRODUCT);
        $moneys = $this->scraper->scrapeExchangeRates($exchangeDocument);

        $this->assertEquals(Money::USD(3.7571), $moneys['USD']);
        $this->assertEquals(Money::EUR(4.2245), $moneys['EUR']);
        $this->assertEquals(Money::GBP(5.4817), $moneys['GBP']);
        $this->assertEquals(Money::AUD(2.8719), $moneys['AUD']);
        $this->assertEquals(Money::ARS(0.2793), $moneys['ARS']);
        $this->assertEquals(Money::CAD(2.8892), $moneys['CAD']);
        $this->assertEquals(Money::NZD(2.6350), $moneys['NZD']);
        $this->assertEquals(Money::CHF(4.0253), $moneys['CHF']);
        $this->assertEquals(Money::JPY(0.0346), $moneys['JPY']);
        $this->assertEquals(Money::CNY(0.6247), $moneys['CNY']);
        $this->assertEquals(Money::CLP(0.0062), $moneys['CLP']);
        $this->assertEquals(Money::MXN(0.2422), $moneys['MXN']);
    }

    public function testScrapeCurrenciesForBeeCambio()
    {
        $exchangeOffice = ExchangeOfficeConfig::get('bee-cambio');
        $exchangeDocument = $this->client->generateDocument($exchangeOffice, ExchangeOfficeConfig::FOREIGN_CURRENCY_PRODUCT);
        $moneys = $this->scraper->scrapeExchangeRates($exchangeDocument);

        $this->assertEquals(Money::USD(3.7184), $moneys['USD']);
        $this->assertEquals(Money::EUR(4.1813), $moneys['EUR']);
        $this->assertEquals(Money::GBP(5.4279), $moneys['GBP']);
        $this->assertEquals(Money::JPY(0.0343), $moneys['JPY']);
        $this->assertEquals(Money::AUD(2.9096), $moneys['AUD']);
        $this->assertEquals(Money::CAD(2.9281), $moneys['CAD']);
        $this->assertEquals(Money::NZD(2.6281), $moneys['NZD']);
        $this->assertEquals(Money::CHF(3.9332), $moneys['CHF']);
        $this->assertEquals(Money::ARS(0.2749), $moneys['ARS']);
        $this->assertEquals(Money::CLP(0.0060), $moneys['CLP']);
        $this->assertEquals(Money::MXN(0.2314), $moneys['MXN']);
        $this->assertEquals(Money::UYU(0.1225), $moneys['UYU']);
        $this->assertEquals(Money::ZAR(0.2614), $moneys['ZAR']);
    }

    public function testScrapeCururrenciesForGradual()
    {
        $exchangeOffice = ExchangeOfficeConfig::get('gradual');
        $exchangeDocument = $this->client->generateDocument($exchangeOffice, ExchangeOfficeConfig::FOREIGN_CURRENCY_PRODUCT);
        $moneys = $this->scraper->scrapeExchangeRates($exchangeDocument);

        $this->assertEquals(Money::USD(4.22), $moneys['USD']);
        $this->assertEquals(Money::EUR(4.61), $moneys['EUR']);
        $this->assertEquals(Money::GBP(6.26), $moneys['GBP']);
        $this->assertEquals(Money::CAD(3.16), $moneys['CAD']);
        $this->assertEquals(Money::AUD(3.15), $moneys['AUD']);
    }

    public function testScrapeCururrenciesForCambioCuritiba()
    {
        $exchangeOffice = ExchangeOfficeConfig::get('cambio-curitiba');
        $exchangeDocument = $this->client->generateDocument($exchangeOffice, ExchangeOfficeConfig::FOREIGN_CURRENCY_PRODUCT);
        $moneys = $this->scraper->scrapeExchangeRates($exchangeDocument);

        $this->assertEquals(Money::USD(3.74), $moneys['USD']);
        $this->assertEquals(Money::EUR(4.25), $moneys['EUR']);
    }

    public function testScrapeCurrenciesForSidney()
    {
        $exchangeOffice = ExchangeOfficeConfig::get('sidney');
        $exchangeDocument = $this->client->generateDocument($exchangeOffice, ExchangeOfficeConfig::FOREIGN_CURRENCY_PRODUCT);
        $moneys = $this->scraper->scrapeExchangeRates($exchangeDocument);

        $this->assertEquals(Money::USD(3.7900), $moneys['USD']);
        $this->assertEquals(Money::AUD(2.9700), $moneys['AUD']);
        $this->assertEquals(Money::CAD(3.0100), $moneys['CAD']);
        $this->assertEquals(Money::EUR(4.3300), $moneys['EUR']);
        $this->assertEquals(Money::CHF(4.1700), $moneys['CHF']);
        $this->assertEquals(Money::JPY(0.0380), $moneys['JPY']);
        $this->assertEquals(Money::GBP(5.4900), $moneys['GBP']);
        $this->assertEquals(Money::ARS(0.3200), $moneys['ARS']);
        $this->assertEquals(Money::CLP(0.0068), $moneys['CLP']);
        $this->assertEquals(Money::UYU(0.1800), $moneys['UYU']);
    }

    public function testScrapeCurrencyCardForSidney()
    {
        $exchangeOffice = ExchangeOfficeConfig::get('sidney');
        $exchangeDocument = $this->client->generateDocument($exchangeOffice, ExchangeOfficeConfig::CURRENCY_CARD_PRODUCT);
        $moneys = $this->scraper->scrapeExchangeRates($exchangeDocument);

        $this->assertEquals(Money::USD(3.7000), $moneys['USD']);
        $this->assertEquals(Money::AUD(2.9200), $moneys['AUD']);
        $this->assertEquals(Money::CAD(2.9600), $moneys['CAD']);
        $this->assertEquals(Money::EUR(4.2800), $moneys['EUR']);
        $this->assertEquals(Money::GBP(5.4200), $moneys['GBP']);
    }

    public function testScrapeCurrenciesForEbadival()
    {
        $exchangeOffice = ExchangeOfficeConfig::get('ebadival');
        $exchangeDocument = $this->client->generateDocument($exchangeOffice, ExchangeOfficeConfig::FOREIGN_CURRENCY_PRODUCT);
        $moneys = $this->scraper->scrapeExchangeRates($exchangeDocument);

        $this->assertEquals(Money::USD(3.74), $moneys['USD']);
        $this->assertEquals(Money::EUR(4.24), $moneys['EUR']);
    }

    public function testScrapeCurrencyCardForEbadival()
    {
        $exchangeOffice = ExchangeOfficeConfig::get('ebadival');
        $exchangeDocument = $this->client->generateDocument($exchangeOffice, ExchangeOfficeConfig::CURRENCY_CARD_PRODUCT);
        $moneys = $this->scraper->scrapeExchangeRates($exchangeDocument);

        $this->assertEquals(Money::USD(3.68), $moneys['USD']);
        $this->assertEquals(Money::EUR(4.18), $moneys['EUR']);
    }

    public function testScrapeCurrenciesForAvs()
    {
        $exchangeOffice = ExchangeOfficeConfig::get('avs');
        $exchangeDocument = $this->client->generateDocument($exchangeOffice, ExchangeOfficeConfig::FOREIGN_CURRENCY_PRODUCT);
        $moneys = $this->scraper->scrapeExchangeRates($exchangeDocument);

        $this->assertEquals(Money::USD(3.77), $moneys['USD']);
        $this->assertEquals(Money::EUR(4.28), $moneys['EUR']);
        $this->assertEquals(Money::GBP(5.51), $moneys['GBP']);
        $this->assertEquals(Money::ARS(0.32), $moneys['ARS']);
        $this->assertEquals(Money::UYU(0.16), $moneys['UYU']);
        $this->assertEquals(Money::MXN(0.26), $moneys['MXN']);
        $this->assertEquals(Money::CLP(0.0065), $moneys['CLP']);
        $this->assertEquals(Money::COP(0.0016), $moneys['COP']);
        $this->assertEquals(Money::PEN(1.35), $moneys['PEN']);
        $this->assertEquals(Money::CAD(2.99), $moneys['CAD']);
        $this->assertEquals(Money::AUD(2.97), $moneys['AUD']);
        $this->assertEquals(Money::NZD(2.69), $moneys['NZD']);
//        @todo Implementar log de erros ao invés de lançamento de exceção na raspagem de taxas de câmbio
//        $this->assertEquals(Money::CHF(4.04), $moneys['CHF']);
//        $this->assertEquals(Money::CNY(0.72), $moneys['CNY']);
        $this->assertEquals(Money::JPY(0.037), $moneys['JPY']);
    }

    public function testScrapeCurrencyCardForAvs()
    {
        $exchangeOffice = ExchangeOfficeConfig::get('avs');
        $exchangeDocument = $this->client->generateDocument($exchangeOffice, ExchangeOfficeConfig::CURRENCY_CARD_PRODUCT);
        $moneys = $this->scraper->scrapeExchangeRates($exchangeDocument);

        $this->assertEquals(Money::USD(3.67), $moneys['USD']);
        $this->assertEquals(Money::EUR(4.22), $moneys['EUR']);
        $this->assertEquals(Money::GBP(5.41), $moneys['GBP']);
        $this->assertEquals(Money::CAD(2.91), $moneys['CAD']);
        $this->assertEquals(Money::AUD(2.89), $moneys['AUD']);
    }

    public function testScrapeCurrenciesForDourada()
    {
        $exchangeOffice = ExchangeOfficeConfig::get('dourada');
        $exchangeDocument = $this->client->generateDocument($exchangeOffice, ExchangeOfficeConfig::FOREIGN_CURRENCY_PRODUCT);
        $moneys = $this->scraper->scrapeExchangeRates($exchangeDocument);

        $this->assertEquals(Money::USD(3.74), $moneys['USD']);
        $this->assertEquals(Money::EUR(4.25), $moneys['EUR']);
        $this->assertEquals(Money::GBP(5.38), $moneys['GBP']);
        $this->assertEquals(Money::ARS(0.33), $moneys['ARS']);
        $this->assertEquals(Money::CAD(2.94), $moneys['CAD']);
        $this->assertEquals(Money::JPY(0.0345), $moneys['JPY']);
        $this->assertEquals(Money::CHF(3.98), $moneys['CHF']);
        $this->assertEquals(Money::AUD(2.94), $moneys['AUD']);
        $this->assertEquals(Money::CLP(0.0064), $moneys['CLP']);
    }

    public function testScrapeCurrenciesForOliveiraFranco()
    {
        $exchangeOffice = ExchangeOfficeConfig::get('oliveira-franco');
        $exchangeDocument = $this->client->generateDocument($exchangeOffice, ExchangeOfficeConfig::FOREIGN_CURRENCY_PRODUCT);
        $moneys = $this->scraper->scrapeExchangeRates($exchangeDocument);

        $this->assertEquals(Money::USD(3.36), $moneys['USD']);
        $this->assertEquals(Money::EUR(3.74), $moneys['EUR']);
        $this->assertEquals(Money::GBP(4.53), $moneys['GBP']);
        $this->assertEquals(Money::AUD(2.67), $moneys['AUD']);
        $this->assertEquals(Money::CAD(2.68), $moneys['CAD']);
        $this->assertEquals(Money::ARS(0.32), $moneys['ARS']);
        $this->assertEquals(Money::CHF(3.60), $moneys['CHF']);
        $this->assertEquals(Money::NZD(2.54), $moneys['NZD']);
        $this->assertEquals(Money::CLP(0.0063), $moneys['CLP']);
        $this->assertEquals(Money::MXN(0.22), $moneys['MXN']);
    }

    public function testScrapeCurrenciesForFortur()
    {
        $exchangeOffice = ExchangeOfficeConfig::get('fortur');
        $exchangeDocument = $this->client->generateDocument($exchangeOffice, ExchangeOfficeConfig::FOREIGN_CURRENCY_PRODUCT);
        $moneys = $this->scraper->scrapeExchangeRates($exchangeDocument);

        $this->assertEquals(Money::USD(3.70), $moneys['USD']);
        $this->assertEquals(Money::EUR(4.22), $moneys['EUR']);
        $this->assertEquals(Money::GBP(5.35), $moneys['GBP']);
//        @todo Implementar log de erros ao invés de lançamento de exceção na raspagem de taxas de câmbio
//        $this->assertEquals(Money::CHF(3.80), $moneys['CHF']);
        $this->assertEquals(Money::CAD(2.95), $moneys['CAD']);
        $this->assertEquals(Money::ARS(0.25), $moneys['ARS']);
    }

    public function testScrapeCurrenciesForSadoc()
    {
        $exchangeOffice = ExchangeOfficeConfig::get('sadoc');
        $exchangeDocument = $this->client->generateDocument($exchangeOffice, ExchangeOfficeConfig::FOREIGN_CURRENCY_PRODUCT);
        $moneys = $this->scraper->scrapeExchangeRates($exchangeDocument);

        $this->assertEquals(Money::USD(3.70), $moneys['USD']);
        $this->assertEquals(Money::EUR(4.25), $moneys['EUR']);
        $this->assertEquals(Money::GBP(5.50), $moneys['GBP']);
        $this->assertEquals(Money::CHF(3.85), $moneys['CHF']);
        $this->assertEquals(Money::CAD(3.00), $moneys['CAD']);
        $this->assertEquals(Money::ARS(0.28), $moneys['ARS']);
    }

    public function testScrapeCurrenciesForFairCambio()
    {
        $exchangeOffice = ExchangeOfficeConfig::get('fair-cambio');
        $exchangeDocument = $this->client->generateDocument($exchangeOffice, ExchangeOfficeConfig::FOREIGN_CURRENCY_PRODUCT);
        $moneys = $this->scraper->scrapeExchangeRates($exchangeDocument);

        $this->assertEquals(Money::USD(3.750), $moneys['USD']);
        $this->assertEquals(Money::EUR(4.260), $moneys['EUR']);
        $this->assertEquals(Money::GBP(6.000), $moneys['GBP']);
        $this->assertEquals(Money::ARS(0.400), $moneys['ARS']);
    }

    public function testScrapeCurrencyCardForFairCambio()
    {
        $exchangeOffice = ExchangeOfficeConfig::get('fair-cambio');
        $exchangeDocument = $this->client->generateDocument($exchangeOffice, ExchangeOfficeConfig::CURRENCY_CARD_PRODUCT);
        $moneys = $this->scraper->scrapeExchangeRates($exchangeDocument);

        $this->assertEquals(Money::USD(3.960), $moneys['USD']);
        $this->assertEquals(Money::EUR(4.500), $moneys['EUR']);
        $this->assertEquals(Money::GBP(5.610), $moneys['GBP']);
    }

    public function testScrapeCurrenciesForTourStar()
    {
        $exchangeOffice = ExchangeOfficeConfig::get('tour-star');
        $exchangeDocument = $this->client->generateDocument($exchangeOffice, ExchangeOfficeConfig::FOREIGN_CURRENCY_PRODUCT);
        $moneys = $this->scraper->scrapeExchangeRates($exchangeDocument);

        $this->assertEquals(Money::USD(3.7700), $moneys['USD']);
        $this->assertEquals(Money::EUR(4.2500), $moneys['EUR']);
        $this->assertEquals(Money::ARS(0.3000), $moneys['ARS']);
        $this->assertEquals(Money::CLP(0.0070), $moneys['CLP']);
        $this->assertEquals(Money::CAD(3.0500), $moneys['CAD']);
        $this->assertEquals(Money::CHF(4.0000), $moneys['CHF']);
        $this->assertEquals(Money::AUD(3.0000), $moneys['AUD']);
        $this->assertEquals(Money::GBP(5.7000), $moneys['GBP']);
    }

    public function testScrapeCurrenciesForAfetur()
    {
        $exchangeOffice = ExchangeOfficeConfig::get('afetur');
        $exchangeDocument = $this->client->generateDocument($exchangeOffice, ExchangeOfficeConfig::FOREIGN_CURRENCY_PRODUCT);
        $moneys = $this->scraper->scrapeExchangeRates($exchangeDocument);

        $this->assertEquals(Money::USD(3.83), $moneys['USD']);
        $this->assertEquals(Money::EUR(4.26), $moneys['EUR']);
    }

    public function testScrapeCurrenciesForToppingtur()
    {
        $exchangeOffice = ExchangeOfficeConfig::get('toppingtur');
        $exchangeDocument = $this->client->generateDocument($exchangeOffice, ExchangeOfficeConfig::FOREIGN_CURRENCY_PRODUCT);
        $moneys = $this->scraper->scrapeExchangeRates($exchangeDocument);

        $this->assertEquals(Money::USD(3.80), $moneys['USD']);
        $this->assertEquals(Money::EUR(4.25), $moneys['EUR']);
        $this->assertEquals(Money::GBP(5.90), $moneys['GBP']);
        $this->assertEquals(Money::CHF(4.00), $moneys['CHF']);
        $this->assertEquals(Money::CAD(3.08), $moneys['CAD']);
        $this->assertEquals(Money::ARS(0.38), $moneys['ARS']);
    }

    public function testScrapeCurrenciesForEuroCambio()
    {
        $exchangeOffice = ExchangeOfficeConfig::get('euro-cambio');
        $exchangeDocument = $this->client->generateDocument($exchangeOffice, ExchangeOfficeConfig::FOREIGN_CURRENCY_PRODUCT);
        $moneys = $this->scraper->scrapeExchangeRates($exchangeDocument);

        $this->assertEquals(Money::USD(3.75), $moneys['USD']);
        $this->assertEquals(Money::EUR(4.25), $moneys['EUR']);
        $this->assertEquals(Money::GBP(5.65), $moneys['GBP']);
        $this->assertEquals(Money::CAD(3.00), $moneys['CAD']);
        $this->assertEquals(Money::ARS(0.28), $moneys['ARS']);
    }

    public function testScrapeCurrenciesForCearaTravel()
    {
        $exchangeOffice = ExchangeOfficeConfig::get('ceara-travel');
        $exchangeDocument = $this->client->generateDocument($exchangeOffice, ExchangeOfficeConfig::FOREIGN_CURRENCY_PRODUCT);
        $moneys = $this->scraper->scrapeExchangeRates($exchangeDocument);

        $this->assertEquals(Money::USD(3.78), $moneys['USD']);
        $this->assertEquals(Money::EUR(4.25), $moneys['EUR']);
    }

    public function testScrapeCurrenciesForLuza()
    {
        $exchangeOffice = ExchangeOfficeConfig::get('luza');
        $exchangeDocument = $this->client->generateDocument($exchangeOffice, ExchangeOfficeConfig::FOREIGN_CURRENCY_PRODUCT);
        $moneys = $this->scraper->scrapeExchangeRates($exchangeDocument);

        $this->assertEquals(Money::USD(3.73), $moneys['USD']);
        $this->assertEquals(Money::EUR(4.25), $moneys['EUR']);
        $this->assertEquals(Money::GBP(5.31), $moneys['GBP']);
        $this->assertEquals(Money::CAD(2.87), $moneys['CAD']);
        $this->assertEquals(Money::NZD(2.57), $moneys['NZD']);
        $this->assertEquals(Money::AUD(2.86), $moneys['AUD']);
    }

    public function testScrapeCurrenciesForCambioNet()
    {
        $exchangeOffice = ExchangeOfficeConfig::get('cambio-net');
        $exchangeDocument = $this->client->generateDocument($exchangeOffice, ExchangeOfficeConfig::FOREIGN_CURRENCY_PRODUCT);
        $moneys = $this->scraper->scrapeExchangeRates($exchangeDocument);

        $this->assertEquals(Money::USD(3.78), $moneys['USD']);
        $this->assertEquals(Money::EUR(4.31), $moneys['EUR']);
        $this->assertEquals(Money::GBP(5.53), $moneys['GBP']);
        $this->assertEquals(Money::AUD(2.98), $moneys['AUD']);
        $this->assertEquals(Money::CAD(2.99), $moneys['CAD']);
    }

    public function testScrapeCurrencyCardForCambioNet()
    {
        $exchangeOffice = ExchangeOfficeConfig::get('cambio-net');
        $exchangeDocument = $this->client->generateDocument($exchangeOffice, ExchangeOfficeConfig::CURRENCY_CARD_PRODUCT);
        $moneys = $this->scraper->scrapeExchangeRates($exchangeDocument);

        $this->assertEquals(Money::USD(3.73), $moneys['USD']);
        $this->assertEquals(Money::EUR(4.28), $moneys['EUR']);
        $this->assertEquals(Money::GBP(5.45), $moneys['GBP']);
        $this->assertEquals(Money::CAD(2.93), $moneys['CAD']);
        $this->assertEquals(Money::AUD(2.91), $moneys['AUD']);
    }

    public function testScrapeCurrenciesForFairCambioPoa()
    {
        $exchangeOffice = ExchangeOfficeConfig::get('fair-cambio-poa');
        $exchangeDocument = $this->client->generateDocument($exchangeOffice, ExchangeOfficeConfig::FOREIGN_CURRENCY_PRODUCT);
        $moneys = $this->scraper->scrapeExchangeRates($exchangeDocument);

        $this->assertEquals(Money::USD(3.84), $moneys['USD']);
        $this->assertEquals(Money::AUD(2.99), $moneys['AUD']);
        $this->assertEquals(Money::CAD(3.01), $moneys['CAD']);
        $this->assertEquals(Money::EUR(4.29), $moneys['EUR']);
        $this->assertEquals(Money::GBP(5.51), $moneys['GBP']);
        $this->assertEquals(Money::ARS(0.32), $moneys['ARS']);
        $this->assertEquals(Money::CLP(0.0065), $moneys['CLP']);
        $this->assertEquals(Money::UYU(0.16), $moneys['UYU']);
    }

    public function testScrapeCurrencyCardForFairCambioPoa()
    {
        $exchangeOffice = ExchangeOfficeConfig::get('fair-cambio-poa');
        $exchangeDocument = $this->client->generateDocument($exchangeOffice, ExchangeOfficeConfig::CURRENCY_CARD_PRODUCT);
        $moneys = $this->scraper->scrapeExchangeRates($exchangeDocument);

        $this->assertEquals(Money::USD(3.80), $moneys['USD']);
        $this->assertEquals(Money::EUR(4.26), $moneys['EUR']);
        $this->assertEquals(Money::GBP(5.45), $moneys['GBP']);
    }

    public function testScrapeCurrenciesForCtr()
    {
        $exchangeOffice = ExchangeOfficeConfig::get('ctr');
        $exchangeDocument = $this->client->generateDocument($exchangeOffice, ExchangeOfficeConfig::FOREIGN_CURRENCY_PRODUCT);
        $moneys = $this->scraper->scrapeExchangeRates($exchangeDocument);

        $this->assertEquals(Money::USD(3.7800), $moneys['USD']);
        $this->assertEquals(Money::EUR(4.2900), $moneys['EUR']);
        $this->assertEquals(Money::GBP(5.5000), $moneys['GBP']);
        $this->assertEquals(Money::AUD(2.9700), $moneys['AUD']);
        $this->assertEquals(Money::ARS(0.2900), $moneys['ARS']);
        $this->assertEquals(Money::NZD(2.6800), $moneys['NZD']);
        $this->assertEquals(Money::CAD(2.9800), $moneys['CAD']);
        $this->assertEquals(Money::CHF(4.0800), $moneys['CHF']);
        $this->assertEquals(Money::UYU(0.1370), $moneys['UYU']);
        $this->assertEquals(Money::CLP(0.0062), $moneys['CLP']);
        $this->assertEquals(Money::MXN(0.2600), $moneys['MXN']);
    }

    public function testScrapeCurrencyCardForCtr()
    {
        $exchangeOffice = ExchangeOfficeConfig::get('ctr');
        $exchangeDocument = $this->client->generateDocument($exchangeOffice, ExchangeOfficeConfig::CURRENCY_CARD_PRODUCT);
        $moneys = $this->scraper->scrapeExchangeRates($exchangeDocument);

        $this->assertEquals(Money::USD(3.9600), $moneys['USD']);
        $this->assertEquals(Money::EUR(4.4900), $moneys['EUR']);
        $this->assertEquals(Money::GBP(5.7000), $moneys['GBP']);
        $this->assertEquals(Money::AUD(3.0900), $moneys['AUD']);
        $this->assertEquals(Money::ARS(0.2900), $moneys['ARS']);
        $this->assertEquals(Money::CAD(3.1000), $moneys['CAD']);
    }

    public function testScrapeCurrenciesForIdeal()
    {
        $exchangeOffice = ExchangeOfficeConfig::get('ideal');
        $exchangeDocument = $this->client->generateDocument($exchangeOffice, ExchangeOfficeConfig::FOREIGN_CURRENCY_PRODUCT);
        $moneys = $this->scraper->scrapeExchangeRates($exchangeDocument);

        $this->assertEquals(Money::USD(3.77), $moneys['USD']);
        $this->assertEquals(Money::EUR(4.30), $moneys['EUR']);
        $this->assertEquals(Money::GBP(5.53), $moneys['GBP']);
        $this->assertEquals(Money::AUD(3.00), $moneys['AUD']);
        $this->assertEquals(Money::CAD(2.99), $moneys['CAD']);
        $this->assertEquals(Money::NZD(2.74), $moneys['NZD']);
        $this->assertEquals(Money::CHF(4.04), $moneys['CHF']);
        $this->assertEquals(Money::PEN(1.3835), $moneys['PEN']);
        $this->assertEquals(Money::ARS(0.32), $moneys['ARS']);
        $this->assertEquals(Money::CLP(0.0061), $moneys['CLP']);
        $this->assertEquals(Money::MXN(0.261), $moneys['MXN']);
        $this->assertEquals(Money::UYU(0.1468), $moneys['UYU']);
        $this->assertEquals(Money::ZAR(0.295), $moneys['ZAR']);
        $this->assertEquals(Money::JPY(0.0411), $moneys['JPY']);
        $this->assertEquals(Money::CNY(0.692), $moneys['CNY']);
    }

    public function testScrapeCurrencyCardForIdeal()
    {
        $exchangeOffice = ExchangeOfficeConfig::get('ideal');
        $exchangeDocument = $this->client->generateDocument($exchangeOffice, ExchangeOfficeConfig::CURRENCY_CARD_PRODUCT);
        $moneys = $this->scraper->scrapeExchangeRates($exchangeDocument);

        $this->assertEquals(Money::USD(3.76), $moneys['USD']);
        $this->assertEquals(Money::EUR(4.30), $moneys['EUR']);
        $this->assertEquals(Money::GBP(5.49), $moneys['GBP']);
        $this->assertEquals(Money::AUD(3.01), $moneys['AUD']);
        $this->assertEquals(Money::CAD(3.02), $moneys['CAD']);
        $this->assertEquals(Money::ARS(0.31), $moneys['ARS']);
    }

    public function testScrapeCurrenciesForMontevideu()
    {
        $exchangeOffice = ExchangeOfficeConfig::get('montevideu');
        $exchangeDocument = $this->client->generateDocument($exchangeOffice, ExchangeOfficeConfig::FOREIGN_CURRENCY_PRODUCT);
        $moneys = $this->scraper->scrapeExchangeRates($exchangeDocument);

        $this->assertEquals(Money::USD(3.75), $moneys['USD']);
        $this->assertEquals(Money::AUD(2.98), $moneys['AUD']);
        $this->assertEquals(Money::CAD(2.98), $moneys['CAD']);
        $this->assertEquals(Money::NZD(2.75), $moneys['NZD']);
        $this->assertEquals(Money::EUR(4.27), $moneys['EUR']);
        $this->assertEquals(Money::CHF(4.06), $moneys['CHF']);
        $this->assertEquals(Money::GBP(5.50), $moneys['GBP']);
        $this->assertEquals(Money::MXN(0.2381), $moneys['MXN']);
        $this->assertEquals(Money::ARS(0.30), $moneys['ARS']);
        $this->assertEquals(Money::CLP(0.0061), $moneys['CLP']);
        $this->assertEquals(Money::UYU(0.1311), $moneys['UYU']);
        $this->assertEquals(Money::ZAR(0.2814), $moneys['ZAR']);
        $this->assertEquals(Money::JPY(0.0405), $moneys['JPY']);
        $this->assertEquals(Money::CNY(0.6320), $moneys['CNY']);
    }

    public function testScrapeCurrencyCardForMontevideu()
    {
        $exchangeOffice = ExchangeOfficeConfig::get('montevideu');
        $exchangeDocument = $this->client->generateDocument($exchangeOffice, ExchangeOfficeConfig::CURRENCY_CARD_PRODUCT);
        $moneys = $this->scraper->scrapeExchangeRates($exchangeDocument);

        $this->assertEquals(Money::USD(3.99), $moneys['USD']);
        $this->assertEquals(Money::AUD(3.07), $moneys['AUD']);
        $this->assertEquals(Money::CAD(3.08), $moneys['CAD']);
        $this->assertEquals(Money::EUR(4.55), $moneys['EUR']);
        $this->assertEquals(Money::GBP(5.74), $moneys['GBP']);
        $this->assertEquals(Money::ARS(0.28), $moneys['ARS']);
    }

    public function testScrapeCurrenciesForExim()
    {
        $exchangeOffice = ExchangeOfficeConfig::get('exim');
        $exchangeDocument = $this->client->generateDocument($exchangeOffice, ExchangeOfficeConfig::FOREIGN_CURRENCY_PRODUCT);
        $moneys = $this->scraper->scrapeExchangeRates($exchangeDocument);

        $this->assertEquals(Money::USD(3.78), $moneys['USD']);
    }

    public function testScrapeCurrenciesForAmazoniaAm()
    {
        $exchangeOffice = ExchangeOfficeConfig::get('amazonia-am');
        $exchangeDocument = $this->client->generateDocument($exchangeOffice, ExchangeOfficeConfig::FOREIGN_CURRENCY_PRODUCT);
        $moneys = $this->scraper->scrapeExchangeRates($exchangeDocument);

        $this->assertEquals(Money::USD(3.90), $moneys['USD']);
        $this->assertEquals(Money::CAD(3.16), $moneys['CAD']);
        $this->assertEquals(Money::EUR(4.30), $moneys['EUR']);
        $this->assertEquals(Money::GBP(5.82), $moneys['GBP']);
        $this->assertEquals(Money::CHF(4.22), $moneys['CHF']);
        $this->assertEquals(Money::JPY(0.054), $moneys['JPY']);
    }

    public function testShouldReturnsAmountZeroWhenNotFoundRate()
    {
        $exchangeOffice = $this->getExchangeOfficeWithIndexByRateUndefined();
        $exchangeDocument = $this->client->generateDocument($exchangeOffice, ExchangeOfficeConfig::FOREIGN_CURRENCY_PRODUCT);
        $moneys = $this->scraper->scrapeExchangeRates($exchangeDocument);

        $this->assertEquals(0, $moneys['USD']->getAmount());
    }

    /**
     * @return ExchangeOffice
     */
    private function getExchangeOfficeWithIndexByRateUndefined()
    {
        $foreignCurrency = new ForeignCurrency([
            'url' => 'http://www.exim.com.br',
            'selector' => '#idTaxa > div > table:nth-child(9)',
            'iofIncluded' => false,
            'keywords' => [
                'USD' => [
                    'Turismo'
                ],
            ],
            'indexesByExchangeRate' => [
                'USD' => 2, // undefined offset 2
            ],
        ]);
        $exchangeOffice = new ExchangeOffice([
            'nickname' => 'exim',
            'name' => 'Exim',
            'email' => 'exim@exim.com.br',
            'state' => 'RS',
            'city' => 'porto-alegre',
            'delivery' => true,
            'decode' => false,
            'foreignCurrency' => $foreignCurrency,
            'currencyCard' => null,
        ]);
        return $exchangeOffice;
    }

    public function testScrapeCurrenciesForShoppingTour()
    {
        $exchangeOffice = ExchangeOfficeConfig::get('shopping-tour');
        $exchangeDocument = $this->client->generateDocument($exchangeOffice, ExchangeOfficeConfig::FOREIGN_CURRENCY_PRODUCT);
        $moneys = $this->scraper->scrapeExchangeRates($exchangeDocument);

        $this->assertEquals(Money::USD(3.88), $moneys['USD']);
        $this->assertEquals(Money::EUR(4.39), $moneys['EUR']);
        $this->assertEquals(Money::GBP(5.61), $moneys['GBP']);
    }

    public function testScrapeCurrencyCardForShoppingTour()
    {
        $exchangeOffice = ExchangeOfficeConfig::get('shopping-tour');
        $exchangeDocument = $this->client->generateDocument($exchangeOffice, ExchangeOfficeConfig::CURRENCY_CARD_PRODUCT);
        $moneys = $this->scraper->scrapeExchangeRates($exchangeDocument);

        $this->assertEquals(Money::USD(4.15), $moneys['USD']);
        $this->assertEquals(Money::EUR(4.69), $moneys['EUR']);
        $this->assertEquals(Money::GBP(5.97), $moneys['GBP']);
    }

    public function testScrapeCurrenciesForCarol()
    {
        $exchangeOffice = ExchangeOfficeConfig::get('carol');
        $exchangeDocument = $this->client->generateDocument($exchangeOffice, ExchangeOfficeConfig::FOREIGN_CURRENCY_PRODUCT);
        $moneys = $this->scraper->scrapeExchangeRates($exchangeDocument);

        $this->assertEquals(Money::USD(3.61), $moneys['USD']);
        $this->assertEquals(Money::EUR(4.16), $moneys['EUR']);
        $this->assertEquals(Money::GBP(5.45), $moneys['GBP']);
        $this->assertEquals(Money::CAD(2.97), $moneys['CAD']);
        $this->assertEquals(Money::AUD(2.84), $moneys['AUD']);
        $this->assertEquals(Money::CHF(3.89), $moneys['CHF']);
        $this->assertEquals(Money::JPY(0.0380), $moneys['JPY']);
        $this->assertEquals(Money::ARS(0.29), $moneys['ARS']);
        $this->assertEquals(Money::NZD(2.60), $moneys['NZD']);
        $this->assertEquals(Money::CLP(0.0061), $moneys['CLP']);
        $this->assertEquals(Money::MXN(0.24), $moneys['MXN']);
        $this->assertEquals(Money::UYU(0.13), $moneys['UYU']);
        $this->assertEquals(Money::ZAR(0.28), $moneys['ZAR']);
    }

    public function testScrapeCurrencyCardForCarol()
    {
        $exchangeOffice = ExchangeOfficeConfig::get('carol');
        $exchangeDocument = $this->client->generateDocument($exchangeOffice, ExchangeOfficeConfig::CURRENCY_CARD_PRODUCT);
        $moneys = $this->scraper->scrapeExchangeRates($exchangeDocument);

        $this->assertEquals(Money::USD(3.84), $moneys['USD']);
        $this->assertEquals(Money::EUR(4.43), $moneys['EUR']);
        $this->assertEquals(Money::GBP(5.80), $moneys['GBP']);
        $this->assertEquals(Money::CAD(3.15), $moneys['CAD']);
        $this->assertEquals(Money::AUD(3.03), $moneys['AUD']);
        $this->assertEquals(Money::ARS(0.30), $moneys['ARS']);
    }

    public function testScrapeCurrenciesForMultiMoney()
    {
        $exchangeOffice = ExchangeOfficeConfig::get('multi-money');
        $exchangeDocument = $this->client->generateDocument($exchangeOffice, ExchangeOfficeConfig::FOREIGN_CURRENCY_PRODUCT);
        $moneys = $this->scraper->scrapeExchangeRates($exchangeDocument);

        $this->assertEquals(Money::USD(3.63000), $moneys['USD']);
        $this->assertEquals(Money::EUR(4.12000), $moneys['EUR']);
        $this->assertEquals(Money::GBP(5.46000), $moneys['GBP']);
        $this->assertEquals(Money::ARS(0.30000), $moneys['ARS']);
        $this->assertEquals(Money::JPY(0.03770), $moneys['JPY']);
        $this->assertEquals(Money::CAD(2.97000), $moneys['CAD']);
        $this->assertEquals(Money::AUD(2.80000), $moneys['AUD']);
        $this->assertEquals(Money::NZD(2.59000), $moneys['NZD']);
        $this->assertEquals(Money::CHF(3.94000), $moneys['CHF']);
        $this->assertEquals(Money::CLP(0.00640), $moneys['CLP']);
        $this->assertEquals(Money::MXN(0.25000), $moneys['MXN']);
        $this->assertEquals(Money::UYU(0.15000), $moneys['UYU']);
        $this->assertEquals(Money::NOK(0.59000), $moneys['NOK']);
    }

    public function testScrapeCurrencyCardForMultiMoney()
    {
        $exchangeOffice = ExchangeOfficeConfig::get('multi-money');
        $exchangeDocument = $this->client->generateDocument($exchangeOffice, ExchangeOfficeConfig::CURRENCY_CARD_PRODUCT);
        $moneys = $this->scraper->scrapeExchangeRates($exchangeDocument);

        $this->assertEquals(Money::USD(3.63000), $moneys['USD']);
        $this->assertEquals(Money::EUR(4.12000), $moneys['EUR']);
        $this->assertEquals(Money::GBP(5.44000), $moneys['GBP']);
        $this->assertEquals(Money::ARS(0.30000), $moneys['ARS']);
        $this->assertEquals(Money::CAD(2.95000), $moneys['CAD']);
        $this->assertEquals(Money::AUD(2.78000), $moneys['AUD']);
    }

    public function testScrapeCurrenciesForAlphaCambio()
    {
        $exchangeOffice = ExchangeOfficeConfig::get('alpha-cambio');
        $exchangeDocument = $this->client->generateDocument($exchangeOffice, ExchangeOfficeConfig::FOREIGN_CURRENCY_PRODUCT);
        $moneys = $this->scraper->scrapeExchangeRates($exchangeDocument);

        $this->assertEquals(Money::USD(3.63), $moneys['USD']);
        $this->assertEquals(Money::AUD(2.77), $moneys['AUD']);
        $this->assertEquals(Money::CAD(2.97), $moneys['CAD']);
        $this->assertEquals(Money::NZD(2.65), $moneys['NZD']);
        $this->assertEquals(Money::EUR(4.16), $moneys['EUR']);
        $this->assertEquals(Money::CHF(4.03), $moneys['CHF']);
        $this->assertEquals(Money::JPY(0.038), $moneys['JPY']);
        $this->assertEquals(Money::GBP(5.40), $moneys['GBP']);
        //$this->assertEquals(Money::ARS(0.30000), $moneys['ARS']);
        $this->assertEquals(Money::CLP(0.0063), $moneys['CLP']);
        $this->assertEquals(Money::MXN(0.26), $moneys['MXN']);
        $this->assertEquals(Money::UYU(0.15), $moneys['UYU']);
        $this->assertEquals(Money::CNY(0.72), $moneys['CNY']);
    }

    public function testScrapeCurrencyCardForAlphaCambio()
    {
        $exchangeOffice = ExchangeOfficeConfig::get('alpha-cambio');
        $exchangeDocument = $this->client->generateDocument($exchangeOffice, ExchangeOfficeConfig::CURRENCY_CARD_PRODUCT);
        $moneys = $this->scraper->scrapeExchangeRates($exchangeDocument);

        $this->assertEquals(Money::USD(3.57), $moneys['USD']);
        $this->assertEquals(Money::AUD(2.86), $moneys['AUD']);
        $this->assertEquals(Money::CAD(3.00), $moneys['CAD']);
        $this->assertEquals(Money::EUR(4.16), $moneys['EUR']);
        $this->assertEquals(Money::GBP(5.34), $moneys['GBP']);
    }

    public function testScrapeCurrenciesForTurvicam()
    {
        $exchangeOffice = ExchangeOfficeConfig::get('turvicam');
        $exchangeDocument = $this->client->generateDocument($exchangeOffice, ExchangeOfficeConfig::FOREIGN_CURRENCY_PRODUCT);
        $moneys = $this->scraper->scrapeExchangeRates($exchangeDocument);

        $this->assertEquals(Money::USD(3.75), $moneys['USD']);
        $this->assertEquals(Money::EUR(4.23), $moneys['EUR']);
        $this->assertEquals(Money::GBP(5.58), $moneys['GBP']);
        $this->assertEquals(Money::AUD(2.88), $moneys['AUD']);
        $this->assertEquals(Money::CAD(3.06), $moneys['CAD']);
        $this->assertEquals(Money::NZD(2.68), $moneys['NZD']);
        $this->assertEquals(Money::CHF(3.86), $moneys['CHF']);
        $this->assertEquals(Money::JPY(0.036), $moneys['JPY']);
        $this->assertEquals(Money::ARS(0.28), $moneys['ARS']);
        $this->assertEquals(Money::CLP(0.0060), $moneys['CLP']);
    }

    public function testScrapeCurrencyCardForTurvicam()
    {
        $exchangeOffice = ExchangeOfficeConfig::get('turvicam');
        $exchangeDocument = $this->client->generateDocument($exchangeOffice, ExchangeOfficeConfig::CURRENCY_CARD_PRODUCT);
        $moneys = $this->scraper->scrapeExchangeRates($exchangeDocument);

        $this->assertEquals(Money::USD(3.74), $moneys['USD']);
        $this->assertEquals(Money::EUR(4.24), $moneys['EUR']);
        $this->assertEquals(Money::GBP(5.43), $moneys['GBP']);
        $this->assertEquals(Money::AUD(2.76), $moneys['AUD']);
        $this->assertEquals(Money::CAD(2.93), $moneys['CAD']);
        $this->assertEquals(Money::NZD(2.57), $moneys['NZD']);
    }

    public function testScrapeCurrenciesForMonopolio()
    {
        $exchangeOffice = ExchangeOfficeConfig::get('monopolio');
        $exchangeDocument = $this->client->generateDocument($exchangeOffice, ExchangeOfficeConfig::FOREIGN_CURRENCY_PRODUCT);
        $moneys = $this->scraper->scrapeExchangeRates($exchangeDocument);

        $this->assertEquals(Money::USD(3.75), $moneys['USD']);
        $this->assertEquals(Money::GBP(5.58), $moneys['GBP']);
        $this->assertEquals(Money::EUR(4.22), $moneys['EUR']);
        $this->assertEquals(Money::ARS(0.28), $moneys['ARS']);
        $this->assertEquals(Money::CAD(3.10), $moneys['CAD']);
    }

    public function testScrapeCurrenciesForDinastur()
    {
        $exchangeOffice = ExchangeOfficeConfig::get('dinastur');
        $exchangeDocument = $this->client->generateDocument($exchangeOffice, ExchangeOfficeConfig::FOREIGN_CURRENCY_PRODUCT);
        $moneys = $this->scraper->scrapeExchangeRates($exchangeDocument);

        $this->assertEquals(Money::USD(3.6700), $moneys['USD']);
    }

    public function testScrapeCurrenciesForLhx()
    {
        $exchangeOffice = ExchangeOfficeConfig::get('lhx');
        $exchangeDocument = $this->client->generateDocument($exchangeOffice, ExchangeOfficeConfig::FOREIGN_CURRENCY_PRODUCT);
        $moneys = $this->scraper->scrapeExchangeRates($exchangeDocument);

        $this->assertEquals(Money::USD(3.65), $moneys['USD']);
        $this->assertEquals(Money::EUR(4.10), $moneys['EUR']);
        $this->assertEquals(Money::GBP(5.30), $moneys['GBP']);
        $this->assertEquals(Money::CAD(2.89), $moneys['CAD']);
    }

    public function testScrapeCurrencyCardForLhx()
    {
        $this->markTestIncomplete('Configurações de Scraper da LHx foram removidas.');
        $exchangeOffice = ExchangeOfficeConfig::get('lhx');
        $exchangeDocument = $this->client->generateDocument($exchangeOffice, ExchangeOfficeConfig::CURRENCY_CARD_PRODUCT);
        $moneys = $this->scraper->scrapeExchangeRates($exchangeDocument);

        $this->assertEquals(Money::USD(3.82), $moneys['USD']);
        $this->assertEquals(Money::EUR(4.28), $moneys['EUR']);
        $this->assertEquals(Money::GBP(5.49), $moneys['GBP']);
        $this->assertEquals(Money::CAD(3.00), $moneys['CAD']);
    }

    public function testScrapeCurrenciesForVoeViagens()
    {
        $exchangeOffice = ExchangeOfficeConfig::get('voe-viagens');
        $exchangeDocument = $this->client->generateDocument($exchangeOffice, ExchangeOfficeConfig::FOREIGN_CURRENCY_PRODUCT);
        $moneys = $this->scraper->scrapeExchangeRates($exchangeDocument);

        $this->assertEquals(Money::USD(3.7725), $moneys['USD']);
        $this->assertEquals(Money::EUR(4.2682), $moneys['EUR']);
        $this->assertEquals(Money::GBP(5.5344), $moneys['GBP']);
        $this->assertEquals(Money::CAD(3.0327), $moneys['CAD']);
        $this->assertEquals(Money::JPY(0.0378), $moneys['JPY']);
    }

    public function testScrapeCurrencyCardForVoeViagens()
    {
        $exchangeOffice = ExchangeOfficeConfig::get('voe-viagens');
        $exchangeDocument = $this->client->generateDocument($exchangeOffice, ExchangeOfficeConfig::CURRENCY_CARD_PRODUCT);
        $moneys = $this->scraper->scrapeExchangeRates($exchangeDocument);

        $this->assertEquals(Money::USD(3.9539), $moneys['USD']);
        $this->assertEquals(Money::EUR(4.4804), $moneys['EUR']);
        $this->assertEquals(Money::GBP(5.6730), $moneys['GBP']);
    }

    public function testScrapeCurrenciesForPontalTurismo()
    {
        $exchangeOffice = ExchangeOfficeConfig::get('pontal-turismo');
        $exchangeDocument = $this->client->generateDocument($exchangeOffice, ExchangeOfficeConfig::FOREIGN_CURRENCY_PRODUCT);
        $moneys = $this->scraper->scrapeExchangeRates($exchangeDocument);

        $this->assertEquals(Money::USD(3.67), $moneys['USD']);
        $this->assertEquals(Money::EUR(4.16), $moneys['EUR']);
    }

    public function testScrapeCurrenciesForIvoramtur()
    {
        $exchangeOffice = ExchangeOfficeConfig::get('ivoramtur');
        $exchangeDocument = $this->client->generateDocument($exchangeOffice, ExchangeOfficeConfig::FOREIGN_CURRENCY_PRODUCT);
        $moneys = $this->scraper->scrapeExchangeRates($exchangeDocument);

        $this->assertEquals(Money::USD(3.68), $moneys['USD']);
        $this->assertEquals(Money::CAD(2.93), $moneys['CAD']);
        $this->assertEquals(Money::AUD(2.77), $moneys['AUD']);
        $this->assertEquals(Money::NZD(2.65), $moneys['NZD']);
        $this->assertEquals(Money::EUR(4.17), $moneys['EUR']);
        $this->assertEquals(Money::GBP(5.42), $moneys['GBP']);
        $this->assertEquals(Money::CHF(3.87), $moneys['CHF']);
        $this->assertEquals(Money::JPY(0.0349), $moneys['JPY']);
        $this->assertEquals(Money::CNY(0.6036), $moneys['CNY']);
        $this->assertEquals(Money::CLP(0.0057), $moneys['CLP']);
        $this->assertEquals(Money::UYU(0.128), $moneys['UYU']);
        $this->assertEquals(Money::MXN(0.2250), $moneys['MXN']);
    }

    public function testScrapeCurrencyCardForIvoramtur()
    {
        $exchangeOffice = ExchangeOfficeConfig::get('ivoramtur');
        $exchangeDocument = $this->client->generateDocument($exchangeOffice, ExchangeOfficeConfig::CURRENCY_CARD_PRODUCT);
        $moneys = $this->scraper->scrapeExchangeRates($exchangeDocument);

        $this->assertEquals(Money::USD(3.85), $moneys['USD']);
        $this->assertEquals(Money::CAD(3.07), $moneys['CAD']);
        $this->assertEquals(Money::AUD(2.91), $moneys['AUD']);
        $this->assertEquals(Money::NZD(2.70), $moneys['NZD']);
        $this->assertEquals(Money::EUR(4.40), $moneys['EUR']);
        $this->assertEquals(Money::GBP(5.64), $moneys['GBP']);
    }

    public function testScrapeCurrenciesForAcoriana()
    {
        $exchangeOffice = ExchangeOfficeConfig::get('acoriana');
        $exchangeDocument = $this->client->generateDocument($exchangeOffice, ExchangeOfficeConfig::FOREIGN_CURRENCY_PRODUCT);
        $moneys = $this->scraper->scrapeExchangeRates($exchangeDocument);

        $this->assertEquals(Money::USD(3.68), $moneys['USD']);
        $this->assertEquals(Money::EUR(4.18), $moneys['EUR']);
        $this->assertEquals(Money::GBP(5.52), $moneys['GBP']);
        $this->assertEquals(Money::ARS(0.30), $moneys['ARS']);
    }

    public function testScrapeCurrencyCardForAcoriana()
    {
        $exchangeOffice = ExchangeOfficeConfig::get('acoriana');
        $exchangeDocument = $this->client->generateDocument($exchangeOffice, ExchangeOfficeConfig::CURRENCY_CARD_PRODUCT);
        $moneys = $this->scraper->scrapeExchangeRates($exchangeDocument);

        $this->assertEquals(Money::USD(3.85), $moneys['USD']);
        $this->assertEquals(Money::EUR(4.41), $moneys['EUR']);
        $this->assertEquals(Money::GBP(5.66), $moneys['GBP']);
    }

    public function testScrapeCurrenciesForAlohaCambio()
    {
        $exchangeOffice = ExchangeOfficeConfig::get('aloha-cambio');
        $exchangeDocument = $this->client->generateDocument($exchangeOffice, ExchangeOfficeConfig::FOREIGN_CURRENCY_PRODUCT);
        $moneys = $this->scraper->scrapeExchangeRates($exchangeDocument);

        $this->assertEquals(Money::USD(3.66), $moneys['USD']);
    }

    public function testScrapeCurrenciesForTurismoDez()
    {
        $exchangeOffice = ExchangeOfficeConfig::get('turismo-dez');
        $exchangeDocument = $this->client->generateDocument($exchangeOffice, ExchangeOfficeConfig::FOREIGN_CURRENCY_PRODUCT);
        $moneys = $this->scraper->scrapeExchangeRates($exchangeDocument);

        $this->assertEquals(Money::USD(3.7442), $moneys['USD']);
        $this->assertEquals(Money::EUR(4.2370), $moneys['EUR']);
        $this->assertEquals(Money::GBP(5.5070), $moneys['GBP']);
        $this->assertEquals(Money::CAD(3.0075), $moneys['CAD']);
        $this->assertEquals(Money::JPY(0.0376), $moneys['JPY']);
    }

    public function testScrapeCurrencyCardForTurismoDez()
    {
        $exchangeOffice = ExchangeOfficeConfig::get('turismo-dez');
        $exchangeDocument = $this->client->generateDocument($exchangeOffice, ExchangeOfficeConfig::CURRENCY_CARD_PRODUCT);
        $moneys = $this->scraper->scrapeExchangeRates($exchangeDocument);

        $this->assertEquals(Money::USD(3.9237), $moneys['USD']);
        $this->assertEquals(Money::EUR(4.4369), $moneys['EUR']);
        $this->assertEquals(Money::GBP(5.6449), $moneys['GBP']);
    }

    public function testScrapeCurrencyCardForLastro()
    {
        $exchangeOffice = ExchangeOfficeConfig::get('lastro');
        $exchangeDocument = $this->client->generateDocument($exchangeOffice, ExchangeOfficeConfig::CURRENCY_CARD_PRODUCT);
        $moneys = $this->scraper->scrapeExchangeRates($exchangeDocument);

        $this->assertEquals(Money::USD(3.62000), $moneys['USD']);
        $this->assertEquals(Money::EUR(4.09000), $moneys['EUR']);
        $this->assertEquals(Money::CAD(2.84000), $moneys['CAD']);
        $this->assertEquals(Money::NZD(2.57000), $moneys['NZD']);
        $this->assertEquals(Money::AUD(2.69000), $moneys['AUD']);
        $this->assertEquals(Money::GBP(5.40000), $moneys['GBP']);
    }

    public function testScrapeCurrenciesForTurismoGmt()
    {
        $exchangeOffice = ExchangeOfficeConfig::get('gmt');
        $exchangeDocument = $this->client->generateDocument($exchangeOffice, ExchangeOfficeConfig::FOREIGN_CURRENCY_PRODUCT);
        $moneys = $this->scraper->scrapeExchangeRates($exchangeDocument);

        $this->assertEquals(Money::USD(3.7134), $moneys['USD']);
        $this->assertEquals(Money::EUR(4.1736), $moneys['EUR']);
        $this->assertEquals(Money::GBP(5.5299), $moneys['GBP']);
        $this->assertEquals(Money::CAD(2.9091), $moneys['CAD']);
        $this->assertEquals(Money::CHF(3.9400), $moneys['CHF']);
    }

    public function testScrapeCurrenciesForTurismoCagifinAbc()
    {
        $exchangeOffice = ExchangeOfficeConfig::get('cagifin-abc');
        $exchangeDocument = $this->client->generateDocument($exchangeOffice, ExchangeOfficeConfig::FOREIGN_CURRENCY_PRODUCT);
        $moneys = $this->scraper->scrapeExchangeRates($exchangeDocument);

        $this->assertEquals(Money::USD(3.82), $moneys['USD']);
        $this->assertEquals(Money::EUR(4.28), $moneys['EUR']);
        $this->assertEquals(Money::GBP(5.73), $moneys['GBP']);
    }

    public function testScrapeCurrenciesForTurismoNumatur()
    {
        $exchangeOffice = ExchangeOfficeConfig::get('numatur');
        $exchangeDocument = $this->client->generateDocument($exchangeOffice, ExchangeOfficeConfig::FOREIGN_CURRENCY_PRODUCT);
        $moneys = $this->scraper->scrapeExchangeRates($exchangeDocument);

        $this->assertEquals(Money::USD(3.68), $moneys['USD']);
        $this->assertEquals(Money::EUR(4.12), $moneys['EUR']);
        $this->assertEquals(Money::GBP(5.49), $moneys['GBP']);
    }

    public function testScrapeCurrenciesForInterpolo()
    {
        $exchangeOffice = ExchangeOfficeConfig::get('interpolo');
        $exchangeDocument = $this->client->generateDocument($exchangeOffice, ExchangeOfficeConfig::FOREIGN_CURRENCY_PRODUCT);
        $moneys = $this->scraper->scrapeExchangeRates($exchangeDocument);

        $this->assertEquals(Money::USD(3.73), $moneys['USD']);
        $this->assertEquals(Money::EUR(4.17), $moneys['EUR']);
        $this->assertEquals(Money::GBP(5.6), $moneys['GBP']);
        $this->assertEquals(Money::ARS(0.31), $moneys['ARS']);
        $this->assertEquals(Money::JPY(0.0361), $moneys['JPY']);
        $this->assertEquals(Money::CAD(2.95), $moneys['CAD']);
        $this->assertEquals(Money::AUD(2.81), $moneys['AUD']);
        $this->assertEquals(Money::NZD(2.64), $moneys['NZD']);
        $this->assertEquals(Money::CHF(3.94), $moneys['CHF']);
        $this->assertEquals(Money::CLP(0.0062), $moneys['CLP']);
        $this->assertEquals(Money::MXN(0.25), $moneys['MXN']);
        $this->assertEquals(Money::UYU(0.165), $moneys['UYU']);
        $this->assertEquals(Money::NOK(0.59), $moneys['NOK']);
    }

    public function testScrapeCurrencyCardForInterpolo()
    {
        $exchangeOffice = ExchangeOfficeConfig::get('interpolo');
        $exchangeDocument = $this->client->generateDocument($exchangeOffice, ExchangeOfficeConfig::CURRENCY_CARD_PRODUCT);
        $moneys = $this->scraper->scrapeExchangeRates($exchangeDocument);

        $this->assertEquals(Money::USD(3.73), $moneys['USD']);
        $this->assertEquals(Money::EUR(4.17), $moneys['EUR']);
        $this->assertEquals(Money::GBP(5.58), $moneys['GBP']);
        $this->assertEquals(Money::ARS(0.3), $moneys['ARS']);
        $this->assertEquals(Money::CAD(2.93), $moneys['CAD']);
        $this->assertEquals(Money::AUD(2.79), $moneys['AUD']);
    }

    public function testScrapeCurrenciesForSidneyLondrina()
    {
        $exchangeOffice = ExchangeOfficeConfig::get('sidney-londrina');
        $exchangeDocument = $this->client->generateDocument($exchangeOffice, ExchangeOfficeConfig::FOREIGN_CURRENCY_PRODUCT);
        $moneys = $this->scraper->scrapeExchangeRates($exchangeDocument);

        $this->assertEquals(Money::USD(3.6100), $moneys['USD']);
        $this->assertEquals(Money::AUD(2.7400), $moneys['AUD']);
        $this->assertEquals(Money::CAD(2.8800), $moneys['CAD']);
        $this->assertEquals(Money::EUR(4.0800), $moneys['EUR']);
        $this->assertEquals(Money::CHF(3.9100), $moneys['CHF']);
        $this->assertEquals(Money::JPY(0.0380), $moneys['JPY']);
        $this->assertEquals(Money::GBP(5.2400), $moneys['GBP']);
        $this->assertEquals(Money::ARS(0.3500), $moneys['ARS']);
        $this->assertEquals(Money::CLP(0.0065), $moneys['CLP']);
        $this->assertEquals(Money::UYU(0.1600), $moneys['UYU']);
    }

    public function testScrapeCurrencyCardForSidneyLondrina()
    {
        $exchangeOffice = ExchangeOfficeConfig::get('sidney-londrina');
        $exchangeDocument = $this->client->generateDocument($exchangeOffice, ExchangeOfficeConfig::CURRENCY_CARD_PRODUCT);
        $moneys = $this->scraper->scrapeExchangeRates($exchangeDocument);

        $this->assertEquals(Money::USD(3.5400), $moneys['USD']);
        $this->assertEquals(Money::AUD(2.7000), $moneys['AUD']);
        $this->assertEquals(Money::CAD(2.8400), $moneys['CAD']);
        $this->assertEquals(Money::EUR(4.0300), $moneys['EUR']);
        $this->assertEquals(Money::GBP(5.1800), $moneys['GBP']);
    }

    protected function setUp()
    {
        parent::setUp();
        $this->client = new ExchangeClient('local');
        $this->scraper = new ExchangeScraper();
    }

}
