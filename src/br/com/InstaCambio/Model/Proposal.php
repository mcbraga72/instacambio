<?php

namespace br\com\InstaCambio\Model;


class Proposal
{

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $cellphone;

    /**
     * @var string
     */
    private $email;

    /**
     * @var int
     */
    private $quantity;

    /**
     * @var double
     */
    private $targetRate;

    /**
     * @var double
     */
    private $totalEffectiveValue;

    /**
     * @var string
     */
    private $currency;

    /**
     * @var boolean
     */
    private $sent;

    /**
     * @var ExchangeRate
     */
    private $exchangeRates;

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getCellphone()
    {
        return $this->cellphone;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @return int
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * @return float
     */
    public function getTargetRate()
    {
        return $this->targetRate;
    }

    /**
     * @return float
     */
    public function getTotalEffectiveValue()
    {
        return $this->totalEffectiveValue;
    }

    /**
     * @return string
     */
    public function getCurrency()
    {
        return $this->currency;
    }

    /**
     * @return boolean
     */
    public function isSent()
    {
        return $this->sent;
    }

    /**
     * @return ExchangeRate
     */
    public function getExchangeRates()
    {
        return $this->exchangeRates;
    }

}