<?php

namespace br\com\InstaCambio\Shell\Task\Scrape;

use br\com\InstaCambio\Client\ExchangeClient;
use br\com\InstaCambio\Scraper\ExchangeScraper;

/**
 * @property ExchangeClient $exchangeClient
 * @property ExchangeScraper $exchangeScraper
 */
class ScrapeWorker extends \Worker
{
    /**
     * @var ExchangeScraper
     */
    public $exchangeScraper;

    public function __construct(ExchangeScraper $exchangeScraper)
    {
        $this->exchangeScraper = $exchangeScraper;
    }

    public function run()
    {
        require_once dirname(dirname(dirname(dirname(dirname(dirname(dirname(__FILE__))))))) . DIRECTORY_SEPARATOR . 'bootstrap.php';
    }

    public function start($options = null)
    {
        return parent::start(PTHREADS_INHERIT_NONE);
    }

}