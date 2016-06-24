<?php

if (!defined('ROOT_DIR')) {
    define('ROOT_DIR', dirname(dirname(__FILE__)));
}
if (!defined('DS')) {
    define('DS', DIRECTORY_SEPARATOR);
}
require_once ROOT_DIR . DS . 'vendor' . DS . 'autoload.php';
require_once ROOT_DIR . DS . 'src' . DS . 'Psr4AutoloaderClass.php';
$autoloaderClass = new Psr4AutoloaderClass();
$autoloaderClass->register();
$autoloaderClass->addNamespace('br\com\InstaCambio', ROOT_DIR . DS . 'src' . DS . 'br' . DS . 'com' . DS . 'InstaCambio');
$autoloaderClass->addNamespace('Goutte\Stub', ROOT_DIR . DS . 'tests' . DS . 'Goutte' . DS . 'Stub');
