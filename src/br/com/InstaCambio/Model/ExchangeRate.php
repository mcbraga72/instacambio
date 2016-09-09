<?php

namespace br\com\InstaCambio\Model;

use MongoDB\BSON\ObjectID;
use MongoDB\BSON\Persistable;
use MongoDB\BSON\UTCDatetime;

class ExchangeRate implements Persistable
{
    /**
     * @var string
     */
    private $currency;
    /**
     * @var ExchangeOffice
     */
    private $exchangeOffice;
    /**
     * @var UTCDatetime
     */
    private $update;
    /**
     * @var float
     */
    private $price;
    /**
     * @var string
     */
    private $productType;
    /**
     * @var string
     */
    private $trade;
    /**
     * @var bool
     */
    private $iofIncluded;
    /**
     * @var
     */
    private $id;
    /**
     * @var string
     */
    private $status;

    /**
     * ExchangeRate constructor.
     * @param ExchangeOffice $exchangeOffice
     * @param array $array
     */
    public function __construct(ExchangeOffice $exchangeOffice, array $array = [])
    {
        /** @noinspection PhpParamsInspection */
        $this->id = new ObjectID;
        $this->exchangeOffice = $exchangeOffice;
        if (!empty($array)) {
            $this->currency = $array['currency'];
            $this->update = $array['update'];
            $this->price = $array['price'];
            $this->productType = $array['productType'];
            $this->trade = $array['trade'];
            $this->iofIncluded = $array['iofIncluded'];
            $this->status = 'status';
        }
    }

    /**
     * @return string
     */
    public function getCurrency()
    {
        return $this->currency;
    }

    /**
     * @param string $currency
     * @return ExchangeRate
     */
    public function setCurrency($currency)
    {
        $this->currency = $currency;
        return $this;
    }

    /**
     * @return boolean
     */
    public function getIofIncluded()
    {
        return $this->iofIncluded;
    }

    /**
     * @param boolean $iofIncluded
     * @return $this
     */
    public function setIofIncluded($iofIncluded)
    {
        $this->iofIncluded = $iofIncluded;
        return $this;
    }

    /**
     * @return float
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param float $price
     * @return ExchangeRate
     */
    public function setPrice($price)
    {
        $this->price = $price;
        return $this;
    }

    /**
     * @return string
     */
    public function getProductType()
    {
        return $this->productType;
    }

    /**
     * @param string $productType
     * @return ExchangeRate
     */
    public function setProductType($productType)
    {
        $this->productType = $productType;
        return $this;
    }

    /**
     * @return string
     */
    public function getTrade()
    {
        return $this->trade;
    }

    /**
     * @param string $trade
     * @return ExchangeRate
     */
    public function setTrade($trade)
    {
        $this->trade = $trade;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getUpdate()
    {
        return $this->update;
    }

    /**
     * @param \DateTime $update
     * @return ExchangeRate
     */
    public function setUpdate($update)
    {
        $this->update = $update;
        return $this;
    }

    /**
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param string $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }

    /**
     * @return ExchangeOffice
     */
    public function getExchangeOffice()
    {
        return $this->exchangeOffice;
    }

    /**
     * @param ExchangeOffice $exchangeOffice
     * @return ExchangeRate
     */
    public function setExchangeOffice($exchangeOffice)
    {
        $this->exchangeOffice = $exchangeOffice;
        return $this;
    }

    public function getTotalPrice()
    {
        $totalPrice = $this->price;
        if (!$this->iofIncluded) {
            if ($this->productType === 'foreignCurrency') {
                $totalPrice = $this->price * (1 + ForeignCurrency::IOF / 100);
            } else {
                $totalPrice = $this->price * (1 + CurrencyCard::IOF / 100);
            }
        }

        return $totalPrice;
    }

    /**
     * @return array
     */
    public function bsonSerialize()
    {
        return [
            'exchangeOffice' => $this->exchangeOffice,
            'currency' => $this->currency,
            'update' => $this->update,
            'price' => $this->price,
            'productType' => $this->productType,
            'trade' => $this->trade,
            'iofIncluded' => $this->iofIncluded,
        ];
    }

    /** @noinspection PhpHierarchyChecksInspection
     * @param array $data
     */
    public function bsonUnserialize(array $data)
    {
        $this->exchangeOffice = $data['exchangeOffice'];
        $this->currency = $data['currency'];
        $this->update = $data['update'];
        $this->price = $data['price'];
        $this->productType = $data['productType'];
        $this->trade = $data['trade'];
        $this->iofIncluded = $data['iofIncluded'];
    }
}