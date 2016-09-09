<?php

namespace br\com\InstaCambio\Model;

use br\com\InstaCambio\Config\Database\MysqlClientBuilder;
use MongoDB\BSON\Persistable;
use PDO;
use PDOException;

class ExchangeOffice implements Persistable
{

    /**
     * @var string
     */
    private $nickname;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $email;

    /**
     * @var boolean
     */
    private $decode;
    /**
     * @var CurrencyCard
     */
    private $currencyCard;
    /**
     * @var ForeignCurrency
     */
    private $foreignCurrency;
    /**
     * @var string
     */
    private $state;
    /**
     * @var int
     */
    private $city;
    /**
     * @var bool
     */
    private $delivery;

    public function __construct(array $config = [])
    {
        $this->nickname = $config['nickname'];
        $this->name = $config['name'];
        $this->email = $config['email'];
        $this->decode = (array_key_exists('decode', $config)) ? $config['decode'] : true;
        $this->city = $config['city'];
        $this->state = $config['state'];
        $this->delivery = $config['delivery'];
        $this->currencyCard = $config['currencyCard'];
        $this->foreignCurrency = $config['foreignCurrency'];
    }

    /**
     * @return int
     */
    public function getId($nickname)
    {
        $db = MysqlClientBuilder::getInstance();
        $query = 'SELECT id FROM exchange_offices WHERE nickname="' . $nickname . '"';
        $id = 0;

        try {
            $stmt = $db->prepare($query);
            $stmt->execute();
            while ($row = $stmt->fetch()) {
                $id = $row[0];
            }
            $stmt = null;
        }
        catch (PDOException $e) {
            print $e->getMessage();
        }
        return $id;
    }

    /**
     * @return string
     */
    public function getNickname()
    {
        return $this->nickname;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @return ExchangeOfficeProduct|null
     */
    public function getCurrencyCard()
    {
        return $this->currencyCard;
    }

    /**
     * @return ExchangeOfficeProduct|null
     */
    public function getForeignCurrency()
    {
        return $this->foreignCurrency;
    }

    /**
     * @return string
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * @return int
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * @return boolean
     */
    public function isDecode()
    {
        return $this->decode;
    }

    /**
     * @return ExchangeOfficeProduct[]
     */
    public function getProducts()
    {
        $products = [];
        if (!is_null($this->foreignCurrency)) {
            $products[ExchangeOfficeConfig::FOREIGN_CURRENCY_PRODUCT] = $this->foreignCurrency;
        }
        if (!is_null($this->currencyCard)) {
            $products[ExchangeOfficeConfig::CURRENCY_CARD_PRODUCT] = $this->currencyCard;
        }
        return $products;
    }

    public function bsonSerialize()
    {
        return [
            'name' => $this->name,
            'nickname' => $this->nickname,
            'state' => $this->state,
            'city' => $this->city,
            'delivery' => $this->delivery,
        ];
    }

    /** @noinspection PhpHierarchyChecksInspection */
    /**
     * @param array $data
     */
    public function bsonUnserialize(array $data)
    {
        $this->nickname = $data['nickname'];
        $this->name = $data['name'];
        $this->state = $data['state'];
        $this->city = $data['city'];
        $this->delivery = $data['delivery'];
    }

    /**
     * @return boolean
     */
    public function isDelivery()
    {
        return $this->delivery;
    }

    /**
     * @param boolean $delivery
     */
    public function setDelivery($delivery)
    {
        $this->delivery = $delivery;
    }

}
