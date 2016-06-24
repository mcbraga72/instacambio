<?php

namespace br\com\InstaCambio\Scraper\Strategy;


use br\com\InstaCambio\Model\ExchangeOffice;

class ScraperStrategyBuilder
{
    /**
     * @var ScraperStrategy[]
     */
    private static $scraperStrategies = [];

    /**
     * @param ExchangeOffice $exchangeOffice
     * @return ScraperStrategy
     */
    public static function create(ExchangeOffice $exchangeOffice)
    {
        if ($exchangeOffice->getNickname() === 'pm-turismo')
            return self::instantiateIfNotYet(PmTurismoScraperStrategy::class);

        if ($exchangeOffice->getNickname() === 'sagitur')
            return self::instantiateIfNotYet(SagiturScraperStrategy::class);

        if ($exchangeOffice->getNickname() === 'maxima')
            return self::instantiateIfNotYet(MaximaScraperStrategy::class);

        if ($exchangeOffice->getNickname() === 'picchioni')
            return self::instantiateIfNotYet(PicchioniScraperStrategy::class);

        if ($exchangeOffice->getNickname() === 'golden-money')
            return self::instantiateIfNotYet(GoldenMoneyScraperStrategy::class);

        if ($exchangeOffice->getNickname() === 'amazonia')
            return self::instantiateIfNotYet(AmazoniaScraperStrategy::class);

        if ($exchangeOffice->getNickname() === 'navegantes')
            return self::instantiateIfNotYet(NavegantesScraperStrategy::class);

        if ($exchangeOffice->getNickname() === 'dibran')
            return self::instantiateIfNotYet(DibranScraperStrategy::class);

        if ($exchangeOffice->getNickname() === 'thaler')
            return self::instantiateIfNotYet(ThalerScraperStrategy::class);

        if ($exchangeOffice->getNickname() === 'guitta')
            return self::instantiateIfNotYet(GuittaScraperStrategy::class);

        if ($exchangeOffice->getNickname() === 'luza')
            return self::instantiateIfNotYet(LuzaScraperStrategy::class);

        if ($exchangeOffice->getNickname() === 'shopping-tour')
            return self::instantiateIfNotYet(ShoppingTourScraperStrategy::class);

        if ($exchangeOffice->getNickname() === 'ideal')
            return self::instantiateIfNotYet(IdealScraperStrategy::class);

        if ($exchangeOffice->getNickname() === 'amazonia-am')
            return self::instantiateIfNotYet(AmazoniaAmScraperStrategy::class);

        if ($exchangeOffice->getNickname() === 'turvicam')
            return self::instantiateIfNotYet(TurvicamScraperStrategy::class);

        if ($exchangeOffice->getNickname() === 'lhx')
            return self::instantiateIfNotYet(LhxScraperStrategy::class);

        return self::instantiateIfNotYet(DefaultScraperStrategy::class);
    }

    /**
     * @param $className
     * @return ScraperStrategy
     */
    private static function instantiateIfNotYet($className)
    {
        if (!isset(self::$scraperStrategies[$className])) {
            self::$scraperStrategies[$className] = new $className();
        }
        return self::$scraperStrategies[$className];
    }
}