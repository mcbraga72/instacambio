<?php

namespace br\com\InstaCambio\Shell\Task\Scrape;

use br\com\InstaCambio\Config\Database\DatabaseClientBuilder;
use br\com\InstaCambio\Model\ExchangeOfficeConfig;
use br\com\InstaCambio\Model\ExchangeRate;
use br\com\InstaCambio\Shell\Task\Notifications\NotificationTask;
use MongoDB\Collection;

class NotificationTaskTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var NotificationTask
     */
    private $notificationTask;
    /**
     * @var Collection
     */
    private $notificationCollection;
    /**
     * @var Collection
     */
    private $exchangeRateCollection;

    public function testCountNotificationsNotSent()
    {
        $this->seedDbWithTwoNotificationsAndOneExchangeRate();
        self::assertCount(2, $this->notificationCollection->find(['sent' => false])->toArray());
        self::assertEquals(1, $this->exchangeRateCollection->count());

        $this->notificationTask->execute();
        self::assertCount(0, $this->notificationCollection->find(['sent' => false])->toArray());
    }

    public function seedDbWithTwoNotificationsAndOneExchangeRate()
    {
        $this->notificationCollection->insertMany([
            [
                "name" => "Foo",
                "cellphone" => "999999999",
                "email" => "contato@instacambio.com.br",
                "state" => "SP",
                "city" => "sao-paulo",
                "currency" => "dolar-americano",
                "rate" => 3.634,
                "sent" => false
            ],
            [
                "name" => "Bar",
                "cellphone" => "999999999",
                "email" => "contato@instacambio.com.br",
                "state" => "SP",
                "city" => "sao-paulo",
                "currency" => "dolar-americano",
                "rate" => 3.634,
                "sent" => false
            ]
        ]);

        $expectedExchangeRate = new ExchangeRate(ExchangeOfficeConfig::get('cambio-store'));
        $expectedExchangeRate
            ->setCurrency('USD')
            ->setIofIncluded(false)
            ->setPrice(3.5932)
            ->setProductType('foreignCurrency')
            ->setTrade('buy')
            ->setUpdate(date('c'));
        $this->exchangeRateCollection->insertOne($expectedExchangeRate);
    }

    public function testCheckIfNotificationsAreBeingAttended()
    {
        $this->seedDbWithFiveNotificationsAndOneExchangeRate();
        self::assertCount(5, $this->notificationCollection->find(['sent' => false])->toArray());
        self::assertEquals(1, $this->exchangeRateCollection->count());

        $this->notificationTask->execute();
        self::assertCount(1, $this->notificationCollection->find(['sent' => false])->toArray());
    }

    public function seedDbWithFiveNotificationsAndOneExchangeRate()
    {
        $this->notificationCollection->insertMany([
            [
                "name" => "Foo",
                "cellphone" => "999999999",
                "email" => "contato@instacambio.com.br",
                "state" => "SP",
                "city" => "sao-paulo",
                "currency" => "dolar-americano",
                "rate" => 3.634,
                "sent" => false
            ],
            [
                "name" => "Bar",
                "cellphone" => "999999999",
                "email" => "contato@instacambio.com.br",
                "state" => "SP",
                "city" => "sao-paulo",
                "currency" => "dolar-americano",
                "rate" => 3.634,
                "sent" => false
            ],
            [
                "name" => "Bar",
                "cellphone" => "999999999",
                "email" => "contato@instacambio.com.br",
                "state" => "SP",
                "city" => "sao-paulo",
                "currency" => "dolar-americano",
                "rate" => 3.634,
                "sent" => false
            ],
            [
                "name" => "Bar",
                "cellphone" => "999999999",
                "email" => "contato@instacambio.com.br",
                "state" => "SP",
                "city" => "sao-paulo",
                "currency" => "dolar-americano",
                "rate" => 3.634,
                "sent" => false
            ],
            [
                "name" => "Bar",
                "cellphone" => "999999999",
                "email" => "contato@instacambio.com.br",
                "state" => "SP",
                "city" => "sao-paulo",
                "currency" => "dolar-americano",
                "rate" => 3.632,
                "sent" => false
            ]
        ]);

        $expectedExchangeRate = new ExchangeRate(ExchangeOfficeConfig::get('cambio-store'));
        $expectedExchangeRate
            ->setCurrency('USD')
            ->setIofIncluded(false)
            ->setPrice(3.5932)
            ->setProductType('foreignCurrency')
            ->setTrade('buy')
            ->setUpdate(date('c'));
        $this->exchangeRateCollection->insertOne($expectedExchangeRate);
    }

    public function testIfReturnAnArrayOfTheNotificationsAttended()
    {
        $this->seedDbWithFiveNotificationsAndOneExchangeRate();
        self::assertCount(4, $this->notificationTask->execute());
    }

    public function test()
    {
        $this->seedDbWithThreeNotificationsAndOneExchangeRate();
        self::assertCount(0, $this->notificationTask->execute());
    }

    public function seedDbWithThreeNotificationsAndOneExchangeRate()
    {
        $this->notificationCollection->insertMany([
            [
                "name" => "Foo",
                "cellphone" => "999999999",
                "email" => "contato@instacambio.com.br",
                "state" => "SP",
                "city" => "sao-paulo",
                "currency" => "dolar-americano",
                "rate" => 3, 5932,
                "sent" => false
            ],
            [
                "name" => "Bar",
                "cellphone" => "999999999",
                "email" => "contato@instacambio.com.br",
                "state" => "SP",
                "city" => "sao-paulo",
                "currency" => "dolar-americano",
                "rate" => 3.5930,
                "sent" => false
            ],
            [
                "name" => "Bar",
                "cellphone" => "999999999",
                "email" => "contato@instacambio.com.br",
                "state" => "SP",
                "city" => "sao-paulo",
                "currency" => "dolar-americano",
                "rate" => 3.600,
                "sent" => false
            ],
        ]);

        $expectedExchangeRate = new ExchangeRate(ExchangeOfficeConfig::get('cambio-store'));
        $expectedExchangeRate
            ->setCurrency('USD')
            ->setIofIncluded(false)
            ->setPrice(3.5932)
            ->setProductType('foreignCurrency')
            ->setTrade('buy')
            ->setUpdate(date('c'));
        $this->exchangeRateCollection->insertOne($expectedExchangeRate);
    }

    protected function setUp()
    {
        parent::setUp();
        /**
         * @todo Create model collection class Notification
         */
        $this->notificationCollection = DatabaseClientBuilder::create('test')->selectCollection('notifications');
        $this->notificationCollection->drop();
        $this->exchangeRateCollection = DatabaseClientBuilder::create('test')->selectCollection('exchangeRates');
        $this->exchangeRateCollection->drop();

        $this->notificationTask = new NotificationTask(true);
    }

    protected function tearDown()
    {
        parent::tearDown();
        $this->notificationCollection->drop();
        $this->exchangeRateCollection->drop();
    }

}
