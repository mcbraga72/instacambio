<?php

namespace br\com\InstaCambio\Shell\Task\PageLoader;

use br\com\InstaCambio\Client\ExchangeClient;

/**
 * @property ExchangeClient $exchangeClient
 */
class PageLoadWorker extends \Worker
{
    /**
     * @var ExchangeClient
     */
    public $exchangeClient;

    /**
     * PageLoadWorker constructor.
     * @param ExchangeClient $exchangeClient
     */
    public function __construct(ExchangeClient $exchangeClient)
    {
        $this->exchangeClient = $exchangeClient;
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