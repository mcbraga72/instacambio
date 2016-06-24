<?php

namespace br\com\InstaCambio\Shell\Task\Scrape;

use br\com\InstaCambio\Config\Database\DatabaseClientBuilder;
use br\com\InstaCambio\Filesystem\Directory;
use br\com\InstaCambio\Helper\LogWrapper;
use br\com\InstaCambio\Model\ExchangeDocument;
use br\com\InstaCambio\Model\ExchangeOfficeConfig;
use br\com\InstaCambio\Model\ExchangeRate;
use br\com\InstaCambio\Model\ExchangeScrapeResult;
use br\com\InstaCambio\Model\Money;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Symfony\Component\DomCrawler\Crawler;


class ScrapeTask
{

    /**
     * @var string
     */
    private $environment;
    /**
     * @var Directory
     */
    private $directory;

    public function __construct($environment = 'remote', Directory $directory)
    {
        $this->environment = $environment;
        $this->directory = $directory;
        $this->logger = new Logger('logger');
        $this->logger->pushHandler(new StreamHandler($this->directory->root() . DS . 'logs' . DS . 'scraper_task.log', Logger::INFO, false, 0777));
        $this->logger->pushHandler(new StreamHandler($this->directory->root() . DS . 'logs' . DS . 'scraper_task_errors.log', Logger::ERROR, false, 0777));
    }

    /**
     *
     * @param string[] $nicknameOfTheExchangesOffices
     * @return ExchangeScrapeResult[]
     */
    public function execute(array $nicknameOfTheExchangesOffices = [])
    {
        $this->logger->addInfo('Starting scraper...');
        $pageDirectories = array_filter(scandir($this->directory->root() . DS . 'pages', SCANDIR_SORT_ASCENDING), function ($dirName) {
            if (in_array($dirName, [
                        '.', '..',
                    ]
                ) || strpos($dirName, '-temp') !== false
            )
                return false;
            return true;
        });

        /* @var $exchangeResults ExchangeScrapeResult[] */
        $exchangeResults = [];
        /* @var $logWrappers LogWrapper[] */
        $logWrappers = [];
        $lastDir = array_pop($pageDirectories);
        if (!is_null($lastDir)) {
            $exchangeOffices = ExchangeOfficeConfig::getAll($nicknameOfTheExchangesOffices);

            /* @var $exchangeDocumentsArray ExchangeDocument[] */
            $exchangeDocumentsArray = [];
            foreach ($exchangeOffices as $exchangeOffice) {
                foreach ($exchangeOffice->getProducts() as $productType => $product) {
                    $filename = $this->directory->root() . DS . 'pages' . DS . $lastDir . DS . $exchangeOffice->getNickname() . $productType . '.html';
                    if (file_exists($filename)) {
                        $crawler = new Crawler(
                            file_get_contents($filename)
                        );
                        if ($exchangeOffice->isDecode()) {
                            $htmlContentDecoded = utf8_decode($crawler->html());
                            $crawler = new Crawler(null, $product->getUrl());
                            $crawler->addHtmlContent($htmlContentDecoded);
                        }
                        $exchangeDocumentsArray[$exchangeOffice->getNickname()][$productType] = new ExchangeDocument($crawler, $productType, $exchangeOffice);
                    } else {
                        $message = 'file ' . basename($filename) . ' not exists in ' . basename(dirname($filename));
                        $this->logger->addInfo($message);
                    }
                }
            }
            foreach ($exchangeDocumentsArray as $nickname => $exchangeDocument) {
                /* @var $exchangeDocument ExchangeDocument[] */
                $documentScraperWork = new DocumentScraperWork($exchangeDocument);
                $documentScraperWork->run();
                $exchangeResults[$nickname] = $documentScraperWork->exchangeResults;
                $logWrappers[$nickname] = $documentScraperWork->logWrapper;
            }

            $database = DatabaseClientBuilder::getInstance();
            $collectionexchangeRates = $database->selectCollection('exchangeRates');
            $collectionexchangeRatesHistory = $database->selectCollection('exchangeRatesHistory');
            foreach ($exchangeResults as $nickname => $exchangeResult) {
                foreach ($exchangeResult->getMoneys() as $productType => $moneys) {
                    /* @var $moneys Money[] */
                    if (!empty($moneys)) {
                        foreach ($moneys as $money) {
                            $exchangeOffice = $exchangeResult->getExchangeOffice();
                            /* @var $exchangeRateFound ExchangeRate */
                            $filter = [
                                'currency' => $money->getCurrency(), 'exchangeOffice.nickname' => $exchangeOffice->getNickname(), 'productType' => $productType
                            ];
                            $exchangeRateFound = $collectionexchangeRates->findOne($filter);
                            if ($money->getAmount() != 0) {
                                if (is_null($exchangeRateFound)) {
                                    $exchangeRate = new ExchangeRate($exchangeOffice);
                                    $exchangeRate
                                        ->setCurrency($money->getCurrency())
                                        ->setIofIncluded(ExchangeOfficeConfig::getProductByType($exchangeOffice, $productType)->getIofIncluded())
                                        ->setPrice($money->getAmount())
                                        ->setProductType($productType)
                                        ->setTrade('buy')
                                        ->setUpdate(date('c'));
                                    $collectionexchangeRates->insertOne($exchangeRate);
                                } else if ($exchangeRateFound->getIofIncluded() != ExchangeOfficeConfig::getProductByType($exchangeOffice, $productType)->getIofIncluded() xor $exchangeRateFound->getPrice() != $money->getAmount()) {
                                    $exchangeRate = new ExchangeRate($exchangeOffice);
                                    $exchangeRate
                                        ->setCurrency($exchangeRateFound->getExchangeOffice())
                                        ->setIofIncluded($exchangeRateFound->getIofIncluded())
                                        ->setPrice($exchangeRateFound->getPrice())
                                        ->setProductType($exchangeRateFound->getProductType())
                                        ->setTrade($exchangeRateFound->getTrade())
                                        ->setUpdate($exchangeRateFound->getUpdate());
                                    $collectionexchangeRatesHistory->insertOne($exchangeRate);

                                    $exchangeRateFound
                                        ->setExchangeOffice($exchangeOffice)
                                        ->setCurrency($money->getCurrency())
                                        ->setIofIncluded(ExchangeOfficeConfig::getProductByType($exchangeOffice, $productType)->getIofIncluded())
                                        ->setPrice($money->getAmount())
                                        ->setProductType($productType)
                                        ->setTrade('buy')
                                        ->setUpdate(date('c'));
                                    $collectionexchangeRates->replaceOne($filter, $exchangeRateFound);
                                }
                            }
                        }
                    } else {
                        $this->logger->addInfo('$moneys array is empty', ['exchangeOffice' => $nickname, 'productType' => $productType]);
                    }
                }
            }

            $scraperDirPath = $this->directory->root() . DS . 'scraper';
            rename($this->directory->root() . DS . 'pages' . DS . $lastDir, $scraperDirPath . DS . $lastDir);
            $notScraperDirPath = $this->directory->root() . DS . 'not-scraper';
            foreach ($pageDirectories as $directory) {
                rename($this->directory->root() . DS . 'pages' . DS . $directory, $notScraperDirPath . DS . $directory);
            }

            $excludePageDirectories = array_filter(scandir($scraperDirPath, SCANDIR_SORT_DESCENDING), function ($dirName) {
                if (in_array($dirName, ['.', '..']) !== false)
                    return false;
                return true;
            });
            foreach (array_slice($excludePageDirectories, 1500) as $excludePageDirectory) {
                array_filter(scandir($scraperDirPath . DS . $excludePageDirectory), function ($filename) use ($scraperDirPath, $excludePageDirectory) {
                    if (in_array($filename, ['.', '..']) === false)
                        unlink($scraperDirPath . DS . $excludePageDirectory . DS . $filename);
                });
                rmdir($scraperDirPath . DS . $excludePageDirectory);
            }
        } else {
            $this->logger->addInfo('nothing to do at this time');
        }

        // logging
        $logger = $this->logger;
        foreach ($logWrappers as $logWrapper) {
            foreach ($logWrapper->getLogs() as $logLevel => $log) {
                array_map(
                    function ($log) use ($logger, $logLevel) {
                        $logger->addRecord($logLevel, $log[0], $log[1]);
                    },
                    $log
                );
            }
        }
        $this->logger->addInfo('Done.');
        return $exchangeResults;
    }
}
