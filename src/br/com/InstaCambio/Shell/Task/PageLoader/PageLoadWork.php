<?php

namespace br\com\InstaCambio\Shell\Task\PageLoader;

use br\com\InstaCambio\Client\ExchangeClientException;
use br\com\InstaCambio\Helper\LogWrapper;
use br\com\InstaCambio\Model\ExchangeOffice;
use br\com\InstaCambio\Model\ExchangePageLoadCollection;
use Monolog\Logger;

/**
 * @property PageLoadWorker $worker
 */
class PageLoadWork extends \Collectable
{
    /**
     * @var LogWrapper
     */
    public $logWrapper;
    /**
     * @var ExchangePageLoadCollection
     */
    public $exchangePageLoadCollection;
    /**
     * @var ExchangeOffice
     */
    public $exchangeOffice;
    /**
     * @var bool
     */
    public $garbage = false;

    public function __construct(ExchangeOffice $exchangeOffice)
    {
        $this->exchangeOffice = $exchangeOffice;
    }

    public function run()
    {
        $timeBegin = microtime(true);

        $logWrapper = new LogWrapper();
        $exchangePageLoadCollection = new ExchangePageLoadCollection();
        foreach ($this->exchangeOffice->getProducts() as $index => $product) {
            try {
                $response = $this->worker->exchangeClient->send($this->exchangeOffice, $product);
                $exchangePageLoadCollection->add($index, $response->getBody()->getContents());
            } catch (ExchangeClientException $e) {
                $logWrapper->addLog($e->getMessage(), Logger::ERROR);
            } catch (\Exception $e) {
                $logWrapper->addLog($e->getMessage(), Logger::ERROR);
            }
        }
        $this->exchangePageLoadCollection = $exchangePageLoadCollection;

        $timeSpent = microtime(true) - $timeBegin;
        $logWrapper->addLog("time spent for download pages of the {$this->exchangeOffice->getNickname()}: {$timeSpent} (sec)", Logger::INFO);
        $this->logWrapper = $logWrapper;
        $this->setGarbage();
    }

    public function isGarbage()
    {
        return $this->garbage;
    }

    public function setGarbage()
    {
        $this->garbage = true;
    }

}
