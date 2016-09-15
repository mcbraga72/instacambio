<?php

namespace br\com\InstaCambio\Shell\Task\Scrape;

use br\com\InstaCambio\Client\SlackClient;
use br\com\InstaCambio\Config\Database\MysqlClientBuilder;
use br\com\InstaCambio\Filesystem\Directory;
use br\com\InstaCambio\Helper\LogWrapper;
use br\com\InstaCambio\Model\ExchangeDocument;
use br\com\InstaCambio\Model\ExchangeOfficeConfig;
use br\com\InstaCambio\Model\ExchangeRate;
use br\com\InstaCambio\Model\ExchangeScrapeResult;
use br\com\InstaCambio\Model\Money;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use PDOException;
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
                        SlackClient::slack($message, "crawler");
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

            $db = MysqlClientBuilder::getInstance();

            foreach ($exchangeResults as $nickname => $exchangeResult) {
                foreach ($exchangeResult->getMoneys() as $productType => $moneys) {
                    /* @var $moneys Money[] */
                    if (!empty($moneys)) {
                        foreach ($moneys as $money) {
                            $exchangeOffice = $exchangeResult->getExchangeOffice();

                            /* @var $exchangeRateFound ExchangeRate */

                            $exchangeOfficeId = $exchangeOffice->getId($exchangeOffice->getNickname());
                            $currencyId = $money->getId($money->getCurrency());
                            $tradeId = 1;
                            $cityId = $exchangeOffice->getCity();
                            $productTypeId = ($productType == 'currencyCard') ? 1 : 2;
                            $delivery = $exchangeOffice->isDelivery();
                            $scraper = 1;
                            $created = date('c');
                            $modified = date('c');
                            $price = $money->getAmount();
                            $iofIncluded = ExchangeOfficeConfig::getProductByType($exchangeOffice, $productType)->getIofIncluded();

                            $exchangeRateFoundId = null;
                            $exchangeRateFoundPrice = null;
                            $exchangeRateFoundIofIncluded = null;
                            $exchangeRateFoundDelivery = null;

                            $queryExchangeRate = 'SELECT id, price, iofIncluded, delivery FROM exchange_rates WHERE exchange_office_id=? AND currency_id=? AND trade_id=? AND city_id=? AND product_type_id=?';

                            try {
                                $stmt = $db->prepare($queryExchangeRate);
                                $stmt->bindParam(1, $exchangeOfficeId);
                                $stmt->bindParam(2, $currencyId);
                                $stmt->bindParam(3, $tradeId);
                                $stmt->bindParam(4, $cityId);
                                $stmt->bindParam(5, $productTypeId);
                                $stmt->execute();

                                while ($row = $stmt->fetch()) {
                                    $exchangeRateFoundId = $row[0];
                                    $exchangeRateFoundPrice = $row[1];
                                    $exchangeRateFoundIofIncluded = $row[2];
                                    $exchangeRateFoundDelivery = $row[3];
                                }

                                $stmt = null;
                            }
                            catch (PDOException $e) {
                                print $e->getMessage();
                            }

                            if ($money->getAmount() != 0) {
                                if (is_null($exchangeRateFoundId)) {
                                    $queryExchangeRate = 'INSERT INTO exchange_rates(exchange_office_id, currency_id, trade_id, city_id, product_type_id, delivery, scraper, created, modified, price, iofIncluded) VALUES(?,?,?,?,?,?,?,?,?,?,?)';

                                    try {
                                        $stmt = $db->prepare($queryExchangeRate);
                                        $stmt->bindParam(1, $exchangeOfficeId);
                                        $stmt->bindParam(2, $currencyId);
                                        $stmt->bindParam(3, $tradeId);
                                        $stmt->bindParam(4, $cityId);
                                        $stmt->bindParam(5, $productTypeId);
                                        $stmt->bindParam(6, $delivery);
                                        $stmt->bindParam(7, $scraper);
                                        $stmt->bindParam(8, $created);
                                        $stmt->bindParam(9, $modified);
                                        $stmt->bindParam(10, $price);
                                        $stmt->bindParam(11, $iofIncluded);
                                        $stmt->execute();
                                        $stmt = null;
                                    }
                                    catch (PDOException $e) {
                                        print $e->getMessage();
                                    }
                                } else if ($exchangeRateFoundPrice != $money->getAmount()) {
                                    $queryExchangeRateHistory = 'INSERT INTO exchange_rates_history(exchange_office_id, currency_id, trade_id, city_id, product_type_id, created, price, iofIncluded) VALUES(?,?,?,?,?,?,?,?)';

                                    try {
                                        $stmt = $db->prepare($queryExchangeRateHistory);
                                        $stmt->bindParam(1, $exchangeOfficeId);
                                        $stmt->bindParam(2, $currencyId);
                                        $stmt->bindParam(3, $tradeId);
                                        $stmt->bindParam(4, $cityId);
                                        $stmt->bindParam(5, $productTypeId);
                                        $stmt->bindParam(6, $created);
                                        $stmt->bindParam(7, $price);
                                        $stmt->bindParam(8, $iofIncluded);
                                        $stmt->execute();
                                        $stmt = null;
                                    }
                                    catch (PDOException $e) {
                                        print $e->getMessage();
                                    }

                                    $queryExchangeRate = 'UPDATE exchange_rates SET modified=?, price=? WHERE id=' . $exchangeRateFoundId;

                                    try {
                                        $stmt = $db->prepare($queryExchangeRate);
                                        $stmt->bindParam(1, $modified);
                                        $stmt->bindParam(2, $price);
                                        $stmt->execute();
                                        $stmt = null;
                                    }
                                    catch (PDOException $e) {
                                        print $e->getMessage();
                                    }
                                }

                                if (is_bool($iofIncluded)) {
                                    if ($exchangeRateFoundIofIncluded != $iofIncluded) {
                                        $queryExchangeRate = 'UPDATE exchange_rates SET iofIncluded=? WHERE id=' . $exchangeRateFoundId;

                                        try {
                                            $stmt = $db->prepare($queryExchangeRate);
                                            $stmt->bindParam(1, $iofIncluded);
                                            $stmt->execute();
                                            $stmt = null;
                                        }
                                        catch (PDOException $e) {
                                            print $e->getMessage();
                                        }
                                    }
                                }

                                if (is_bool($delivery)) {
                                    if ($exchangeRateFoundDelivery != $delivery) {
                                        $queryExchangeRate = 'UPDATE exchange_rates SET delivery=? WHERE id=' . $exchangeRateFoundId;

                                        try {
                                            $stmt = $db->prepare($queryExchangeRate);
                                            $stmt->bindParam(1, $delivery);
                                            $stmt->execute();
                                            $stmt = null;
                                        }
                                        catch (PDOException $e) {
                                            print $e->getMessage();
                                        }
                                    }
                                }
                            }
                        }
                    } else {
                        $this->logger->addInfo('$moneys array is empty', ['exchangeOffice' => $nickname, 'productType' => $productType]);
                        $message = '$moneys array is empty. Exchange Office: ' . $nickname . ' / Product Type: ' . $productType;
                        SlackClient::slack($message, "crawler");
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

    public function disableExchangeRatesOutdated()
    {
        $acceptableDate = (new \DateTime());
        $acceptableDate->sub(new \DateInterval('P5D'));

        $db = MysqlClientBuilder::getInstance();
        $queryExchangeRate = 'UPDATE exchange_rates SET status=0 WHERE modified < "' . $acceptableDate->format('Y-m-d H:i:s') . '"';

        try {
            $stmt = $db->prepare($queryExchangeRate);
            $stmt->execute();
            $stmt = null;
        }
        catch (PDOException $e) {
            print $e->getMessage();
        }
    }
}
