<?php

use br\com\InstaCambio\Filesystem\Directory;
use br\com\InstaCambio\Shell\Task\Scrape\ScrapeTask;

require __DIR__ . DIRECTORY_SEPARATOR . 'src' . DIRECTORY_SEPARATOR . 'bootstrap.php';

$scrapeTask = new ScrapeTask('remote', new Directory(ROOT_DIR . DIRECTORY_SEPARATOR . 'tmp'));
$scrapeTask->execute();