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

    /**
     * Dólar Americano
     * @param $amount
     * @return Money
     */
    public static function USD($amount)
    {
        return new Money($amount, 'USD');
    }

    /**
     * Euro
     * @param $amount
     * @return Money
     */
    public static function EUR($amount)
    {
        return new Money($amount, 'EUR');
    }

    /**
     * Libra Esterlina
     * @param $amount
     * @return Money
     */
    public static function GBP($amount)
    {
        return new Money($amount, 'GBP');
    }

    /**
     * Dólar Canadense
     * @param $amount
     * @return Money
     */
    public static function CAD($amount)
    {
        return new Money($amount, 'CAD');
    }

    /**
     * Dólar Australiano
     * @param $amount
     * @return Money
     */
    public static function AUD($amount)
    {
        return new Money($amount, 'AUD');
    }

    /**
     * Peso Argentino
     * @param $amount
     * @return Money
     */
    public static function ARS($amount)
    {
        return new Money($amount, 'ARS');
    }

    /**
     * Iene Japonês
     * @param $amount
     * @return Money
     */
    public static function JPY($amount)
    {
        return new Money($amount, 'JPY');
    }

    /**
     * Peso Chileno
     * @param $amount
     * @return Money
     */
    public static function CLP($amount)
    {
        return new Money($amount, 'CLP');
    }

    /**
     * Franco Suíço
     * @param $amount
     * @return Money
     */
    public static function CHF($amount)
    {
        return new Money($amount, 'CHF');
    }

    /**
     * Dólar Neozelandês
     * @param $amount
     * @return Money
     */
    public static function NZD($amount)
    {
        return new Money($amount, 'NZD');
    }

    /**
     * Peso Mexicano
     * @param $amount
     * @return Money
     */
    public static function MXN($amount)
    {
        return new Money($amount, 'MXN');
    }

    /**
     * Peso Uruguaio
     * @param $amount
     * @return Money
     */
    public static function UYU($amount)
    {
        return new Money($amount, 'UYU');
    }

    /**
     * Yuan Chinês
     * @param $amount
     * @return Money
     */
    public static function CNY($amount)
    {
        return new Money($amount, 'CNY');
    }

    /**
     * Rand Sul-Africano
     * @param $amount
     * @return Money
     */
    public static function ZAR($amount)
    {
        return new Money($amount, 'ZAR');
    }

    /**
     * Coroa Dinamarquesa
     * @param $amount
     * @return Money
     */
    public static function DKK($amount)
    {
        return new Money($amount, 'DKK');
    }

    /**
     * Coroa Sueca
     * @param $amount
     * @return Money
     */
    public static function SEK($amount)
    {
        return new Money($amount, 'SEK');
    }

    /**
     * Novo Sul Peruano
     * @param $amount
     * @return Money
     */
    public static function PEN($amount)
    {
        return new Money($amount, 'PEN');
    }

    /**
     * Coroa Norueguesa
     * @param $amount
     * @return Money
     */
    public static function NOK($amount)
    {
        return new Money($amount, 'NOK');
    }

    /**
     * Peso Boliviano
     * @param $amount
     * @return Money
     */
    public static function BOB($amount)
    {
        return new Money($amount, 'BOB');
    }

    /**
     * Shekel Israelense
     * @param $amount
     * @return Money
     */
    public static function ILS($amount)
    {
        return new Money($amount, 'ILS');
    }

    /**
     * Peso Colombiano
     * @param $amount
     * @return Money
     */
    public static function COP($amount)
    {
        return new Money($amount, 'COP');
    }

    /**
     * Won Sul-Coreano
     * @param $amount
     * @return Money
     */
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
