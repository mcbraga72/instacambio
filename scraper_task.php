<?php

use br\com\InstaCambio\Model\ExchangeOfficeConfig;
use br\com\InstaCambio\Webservice\RestApplication;
use Illuminate\Container\Container;
use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Events\Dispatcher;

require_once __DIR__ . DIRECTORY_SEPARATOR . 'src' . DIRECTORY_SEPARATOR . 'bootstrap.php';
require_once __DIR__ . DIRECTORY_SEPARATOR . 'index.php';

$exchangeOffices = new ArrayObject();
$cities = new ArrayObject();


$capsule = new Capsule;
$capsule->addConnection($container['settings']['db']);
$capsule->setEventDispatcher(new Dispatcher(new Container));
$capsule->setAsGlobal();
$capsule->bootEloquent();
foreach (ExchangeOfficeConfig::getAll() as $exchangeOffice) {
    $db = $capsule->table('cities');
    $city = RestApplication::citiesMap()[$exchangeOffice->getCity()];
    $record = $db->where('name', '=', $city)->first();

    $cities->append($city);
    $exchangeOffices->append([
        'nickname' => $exchangeOffice->getNickname(),
        'name' => $exchangeOffice->getName(),
        'email' => $exchangeOffice->getEmail(),
        'password' => '',
        'delivery' => $exchangeOffice->isDelivery(),
        'status' => true,
        'citi_id' => $record['id'],
    ]);
    echo <<<HTML
        \n[
        'nickname' => "{$exchangeOffice->getNickname()}",
        'name' => "{$exchangeOffice->getName()}",
        'email' => "{$exchangeOffice->getEmail()}",
        'password' => '',
        'delivery' => {$exchangeOffice->isDelivery()},
        'status' => true,
        'citi_id' => "{$record['id']}",
        ],    
HTML;
}
//var_dump($cities);