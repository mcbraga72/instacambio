<?php

namespace br\com\InstaCambio\Config\Database;

use PDO;
use PDOException;

/**
 * Class MysqlClientBuilder
 * @package br\com\InstaCambio\Config\Database
 */
class MysqlClientBuilder
{
    private static $instance;

    public static function getInstance()
    {
        if (is_null(self::$instance))
            return self::create();

        return self::$instance;
    }

    public static function create()
    {
        $parsedConfiguration = parse_ini_file(ROOT_DIR . DIRECTORY_SEPARATOR . 'app.ini');
        $user = $parsedConfiguration['db.user'];
        $password = $parsedConfiguration['db.pass'];

        try {
            self::$instance = new PDO('mysql:host=localhost;dbname=admin_instacambio', $user, $password, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
        } catch (PDOException $e) {
            print "Error: " . $e->getMessage();
            die();
        }
        return self::$instance;
    }

}