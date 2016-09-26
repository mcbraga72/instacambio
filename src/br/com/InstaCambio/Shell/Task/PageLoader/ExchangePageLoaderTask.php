<?php

namespace br\com\InstaCambio\Shell\Task\PageLoader;

use br\com\InstaCambio\Client\ExchangeClient;
use br\com\InstaCambio\Filesystem\Directory;
use br\com\InstaCambio\Model\ExchangeOfficeConfig;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;

class ExchangePageLoaderTask
{
    private $logger;
    private $tempRootDir;
    /**
     * @var string
     */
    private $environment;

    /**
     * @var Directory
     */
    private $directory;

    /**
     * ExchangePageLoaderTask constructor.
     * @param string $environment
     * @param Directory $directory
     */
    public function __construct($environment = 'remote', Directory $directory)
    {
        $this->environment = $environment;
        $this->directory = $directory;
        $this->tempRootDir = $this->directory->root() . '-temp';
        rename($this->directory->root(), $this->tempRootDir);
        $this->logger = new Logger('logger');
        // This filename is used by server for reboot scripts. Don't change
        $this->logger->pushHandler(new StreamHandler(dirname(dirname($this->directory->root())) . DS . 'logs' . DS . 'page_loader_task.log', Logger::INFO, false, 0777));
        $this->logger->pushHandler(new StreamHandler(dirname(dirname($this->directory->root())) . DS . 'logs' . DS . 'page_loader_task_errors.log', Logger::ERROR, false, 0777));
    }


    /**
     * @param array $nicknames
     */
    public function execute($nicknames = [])
    {
        $this->logger->addInfo('Starting downloads...');
        $timeBegin = microtime(true);

        $exchangeOffices = ExchangeOfficeConfig::getAll($nicknames);
        $pool = new \Pool(count($exchangeOffices), PageLoadWorker::class, [new ExchangeClient($this->environment)]);
        /** @var PageLoadWork[] $works */
        $works = [];
        foreach ($exchangeOffices as $index => $exchangeOffice) {
            $works[$exchangeOffice->getNickname()] = new PageLoadWork($exchangeOffice);
            $pool->submit($works[$exchangeOffice->getNickname()]);
        }
        $pool->collect(function (PageLoadWork $collectable) {
            return $collectable->isGarbage();
        });
        $pool->shutdown();

        $timeSpent = microtime(true) - $timeBegin;
        $this->logger->addInfo("time spent for download {$timeSpent} (seconds)");

        foreach ($works as $nickname => $work) {
            $exchangePageLoadCollection = $works[$nickname]->exchangePageLoadCollection;
            foreach ($exchangePageLoadCollection->all() as $index => $contentPage) {
                $file = new \SplFileObject($this->tempRootDir . DS . $nickname . $index . '.html', 'w');
                $file->fwrite($contentPage);
                $filename = $file->getPathname();
                $file = null;
                chmod($filename, 0777);
                $this->logger->addInfo("page hash {$index} (1-currency Card, 2-foreign currency): " . md5_file($filename));
            }

            // logging
            $logger = $this->logger;
            $logs = $works[$nickname]->logWrapper->getLogs();
            foreach ($logs as $logLevel => $log) {
                array_map(
                    function ($log) use ($logger, $logLevel) {
                        $logger->addRecord($logLevel, $log[0], $log[1]);
                    },
                    $log
                );
            }
        }
        rename($this->tempRootDir, $this->directory->root());

        $timeSpent = microtime(true) - $timeBegin;
        $this->logger->addInfo("time spent for save html files {$timeSpent} (seconds)");
        $memoryUsage = memory_get_peak_usage(true) / 1024 / 1024;
        $this->logger->addInfo("total memory usage: {$memoryUsage} (MB)");
    }

    /**
     * @param Directory $directory
     * @return void
     */
    public function setDirectory(Directory $directory)
    {
        $this->directory = $directory;
    }

}
