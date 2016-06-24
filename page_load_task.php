<?php

use br\com\InstaCambio\Filesystem\Directory;
use br\com\InstaCambio\Shell\Task\PageLoader\ExchangePageLoaderTask;

require dirname(__FILE__) . DIRECTORY_SEPARATOR . 'src' . DIRECTORY_SEPARATOR . 'bootstrap.php';
$exchangePageLoader = new ExchangePageLoaderTask('remote', new Directory(ROOT_DIR . DIRECTORY_SEPARATOR . 'tmp' . DIRECTORY_SEPARATOR . 'pages' . DIRECTORY_SEPARATOR . date('YmdHis')));
$exchangePageLoader->execute();
unset($exchangePageLoader);