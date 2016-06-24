<?php

namespace br\com\InstaCambio\Model;

class Money
{

    private $currency;

    /**
     * @var float
     */
    private $amount;

    private function __construct($amount, $currency)
    {
        $this->amount = $amount;
        $this->currency = $currency;
    }

    public static function USD($amount)
    {
        return new Money($amount, 'USD');
    }

    public static function EUR($amount)
    {
        return new Money($amount, 'EUR');
    }

    public static function GBP($amount)
    {
        return new Money($amount, 'GBP');
    }

    public static function CAD($amount)
    {
        return new Money($amount, 'CAD');
    }

    public static function AUD($amount)
    {
        return new Money($amount, 'AUD');
    }

    public static function ARS($amount)
    {
        return new Money($amount, 'ARS');
    }

    public static function JPY($amount)
    {
        return new Money($amount, 'JPY');
    }

    public static function CLP($amount)
    {
        return new Money($amount, 'CLP');
    }

    public static function CHF($amount)
    {
        return new Money($amount, 'CHF');
    }

    public static function NZD($amount)
    {
        return new Money($amount, 'NZD');
    }

    public static function MXN($amount)
    {
        return new Money($amount, 'MXN');
    }

    public static function UYU($amount)
    {
        return new Money($amount, 'UYU');
    }

    public static function CNY($amount)
    {
        return new Money($amount, 'CNY');
    }

    public static function ZAR($amount)
    {
        return new Money($amount, 'ZAR');
    }

    public static function DKK($amount)
    {
        return new Money($amount, 'DKK');
    }

    public static function SEK($amount)
    {
        return new Money($amount, 'SEK');
    }

    public static function PEN($amount)
    {
        return new Money($amount, 'PEN');
    }

    public static function NOK($amount)
    {
        return new Money($amount, 'NOK');
    }

    public static function BOB($amount)
    {
        return new Money($amount, 'BOB');
    }

    public static function ILS($amount)
    {
        return new Money($amount, 'ILS');
    }

    public static function COP($amount)
    {
        return new Money($amount, 'COP');
    }

    public static function KRW($amount)
    {
        return new Money($amount, 'KRW');
    }

    /**
     * @param $amount
     * @param $currency
     * @return Money
     */
    public static function create($amount, $currency)
    {
        return Money::$currency($amount);
    }

    public function getCurrency()
    {
        return $this->currency;
    }


    /**
     * @return float
     */
    public function getAmount()
    {
        return $this->amount;
    }

}
