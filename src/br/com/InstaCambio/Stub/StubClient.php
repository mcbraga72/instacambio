<?php

namespace br\com\InstaCambio\Stub;

use Symfony\Component\DomCrawler\Crawler;

class StubClient
{
    const ROOT_DIR_TESTS_PAGES = ROOT_DIR . DS . 'tests' . DS . 'pages';
    const ROOT_DIR_TESTS_FOREIGN_CURRENCY_PAGES = self::ROOT_DIR_TESTS_PAGES . DS . 'foreign-currency';
    const ROOT_DIR_TESTS_CURRENCY_CARD_PAGES = self::ROOT_DIR_TESTS_PAGES . DS . 'currency-card';

    public function request($method, $uri)
    {
        $pagesPath = self::ROOT_DIR_TESTS_PAGES . DS;
        $stubFilePaths = new StubFilePaths();
        $filePaths = $stubFilePaths->filePaths;
        if (file_exists($pagesPath . $filePaths[$uri])) {
            $crawler = new Crawler(
                file_get_contents($pagesPath . $filePaths[$uri])
            );
        } else {
            $crawler = new Crawler(
                file_get_contents($pagesPath . $filePaths['http://www.example.com/'])
            );
        }
        return $crawler;
    }

}
