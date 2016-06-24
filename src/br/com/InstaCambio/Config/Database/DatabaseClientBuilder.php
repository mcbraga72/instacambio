<?php

namespace br\com\InstaCambio\Config\Database;

use MongoDB\Client;
use MongoDB\Database;

/**
 * Class DatabaseClientBuilder
 * @package br\com\InstaCambio\Config\Database
 */
class DatabaseClientBuilder
{
    /**
     * @var Database
     */
    private static $instance;

    /**
     * @return Database
     */
    public static function getInstance()
    {
        if (is_null(self::$instance))
            return self::create('instacambio');

        return self::$instance;
    }

    /**
     * @param $databaseName
     * @return Database
     */
    public static function create($databaseName)
    {
        $client = new Client();
        return self::$instance = $client->selectDatabase($databaseName);
    }

}