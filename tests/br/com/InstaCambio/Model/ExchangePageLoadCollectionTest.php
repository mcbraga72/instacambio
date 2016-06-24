<?php

namespace br\com\InstaCambio\Model;

class ExchangePageLoadCollectionTest extends \PHPUnit_Framework_TestCase
{

    public function testAddContentAndGetContentByIndex()
    {
        $exchangeLoadResultCollection = new ExchangePageLoadCollection();
        $htmlContent = '<body>any html content</body>';
        $exchangeLoadResultCollection->add(ExchangeOfficeConfig::FOREIGN_CURRENCY_PRODUCT, $htmlContent);

        $this->assertEquals($htmlContent, $exchangeLoadResultCollection->get(ExchangeOfficeConfig::FOREIGN_CURRENCY_PRODUCT));
    }

    /**
     * @expectedException \OutOfBoundsException
     */
    public function testThrowsExceptionIfIndexIsNotSet()
    {
        $exchangeLoadResultCollection = new ExchangePageLoadCollection();
        // nothing added yet
        $exchangeLoadResultCollection->get(ExchangeOfficeConfig::FOREIGN_CURRENCY_PRODUCT);
    }

    public function testAllPagesInTheCollection()
    {
        $exchangeLoadResultCollection = new ExchangePageLoadCollection();
        $htmlContent = '<body>any html content</body>';
        $exchangeLoadResultCollection->add(ExchangeOfficeConfig::FOREIGN_CURRENCY_PRODUCT, $htmlContent);
        $htmlContent = '<body>any html content</body>';
        $exchangeLoadResultCollection->add(ExchangeOfficeConfig::CURRENCY_CARD_PRODUCT, $htmlContent);

        $this->assertCount(2, $exchangeLoadResultCollection->all());

    }


}
