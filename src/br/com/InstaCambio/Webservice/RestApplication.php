<?php

namespace br\com\InstaCambio\Webservice;

use br\com\InstaCambio\Config\Database\DatabaseClientBuilder;
use br\com\InstaCambio\Config\Database\MysqlClientBuilder;
use br\com\InstaCambio\Model\ExchangeOfficeConfig;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use PDO;
use PDOException;

class RestApplication
{
    /**
     * @var Logger
     */
    private $logger;
    /**
     * @var \PHPMailer
     */
    private $mailer;
    /**
     * @var bool
     */
    private $debugMode;

    /**
     * RestApplication constructor.
     * @param bool $debugMode
     */
    public function __construct($debugMode = false)
    {
        $this->debugMode = $debugMode;
        $this->logger = new Logger('restAppLogger');
        $this->logger->pushHandler(new StreamHandler(ROOT_DIR . DS . 'tmp' . DS . 'logs' . DS . 'mailer.log', Logger::INFO, false, 0777));
        $this->logger->pushHandler(new StreamHandler(ROOT_DIR . DS . 'tmp' . DS . 'logs' . DS . 'mailer.log', Logger::DEBUG, false, 0777));
        $this->logger->pushHandler(new StreamHandler(ROOT_DIR . DS . 'tmp' . DS . 'logs' . DS . 'mailer.log', Logger::ERROR, false, 0777));
        $this->mailer = new \PHPMailer();
    }

    /**
     * @param $args
     * @return array
     */
    public function getExchangeRates($args)
    {
        $db = MysqlClientBuilder::getInstance();

        $citiesNameToSlug = self::citiesNameToSlug();
        $citiesSlugToName = self::citiesSlugToName();
        $cityName = (key_exists($args['city'], $citiesSlugToName)) ? $citiesSlugToName[$args['city']] : str_replace('-', ' ', ucfirst($args['city']));
        $currencySymbol = $this->currencySlugToCurrencySymbol($args['currency']);
        $acceptableDate = (new \DateTime());
        $acceptableDate->sub(new \DateInterval('P5D'));
        $modified = $acceptableDate->format('c');

        if ($args['trade'] === "comprar") {
            $tradeOption = "Cliente compra";
        } else {
            $tradeOption = "Cliente vende";
        }
        if ($args['delivery'] === "delivery") {
            $delivery = 1;
        } else {
            $delivery = 0;
        }
        if ($args['productType'] === "papel-moeda") {
            $productType = 'Papel moeda';
        } else {
            $productType = 'Cartão pré-pago';
        }

        $results = [];

        $query = 'SELECT DISTINCT cr.currency, er.iofIncluded, er.price, pt.name, t.name, er.modified, eo.nickname, eo.name, s.uf, c.name, er.delivery FROM cities c, currencies cr, exchange_offices eo, exchange_rates er, product_types pt, states s, trades t WHERE eo.status=1 AND c.name=? AND cr.currency=? AND t.name=? AND er.delivery=? AND pt.name=? AND er.modified>? AND cr.id=er.currency_id AND c.state_id=s.id AND c.id=er.city_id AND eo.id=er.exchange_office_id AND er.product_type_id=pt.id AND er.trade_id=t.id ORDER BY er.price';

        try {
            $stmt = $db->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
            $stmt->bindParam(1, $cityName);
            $stmt->bindParam(2, $currencySymbol);
            $stmt->bindParam(3, $tradeOption);
            $stmt->bindParam(4, $delivery);
            $stmt->bindParam(5, $productType);
            $stmt->bindParam(6, $modified);
            $stmt->execute();
            while ($row = $stmt->fetch(PDO::FETCH_NUM, PDO::FETCH_ORI_NEXT)) {
                if(!is_null($row[0])) {
                    $result['currency'] = $row[0];
                    $result['iofIncluded'] = ($row[1] == 0) ? false : true;
                    $result['price'] = $row[2];
                    $result['productType'] = ($row[3] == "Papel moeda") ? "foreignCurrency" : "currencyCard";
                    $result['trade'] = ($row[4] == "Cliente compra") ? "buy" : "sell";
                    $result['modified'] = $row[5];
                    $result['nickname'] = $row[6];
                    $result['name'] = $row[7];
                    $result['state'] = $row[8];
                    $result['city'] = (key_exists($row[9], $citiesNameToSlug)) ? $citiesNameToSlug[$row[9]] : str_replace(' ', '-', ucfirst($row[9]));
                    $result['delivery'] = ($row[10] == 0) ? false : true;
                    $result['totalPrice'] = ($row[1] == false) ? ($row[3] == "Papel moeda") ? $row[2] * 1.011 : $row[2] * 1.0638 : $row[2];

                    $results[] = $result;
                }
            }
            $stmt = null;
        }
        catch (PDOException $e) {
            print $e->getMessage();
        }

        return $results;
    }

    /**
     * @param $userCurrency
     * @return string
     */
    public function currencySlugToCurrencySymbol($userCurrency)
    {
        return RestApplication::currencySlugToCurrencySymbolStatic($userCurrency);
    }

    public static function currencySlugToCurrencySymbolStatic($userCurrency)
    {
        switch ($userCurrency) {
            case "coroa-dinamarquesa":
                $userCurrency = "DKK";
                break;
            case "coroa-norueguesa":
                $userCurrency = "NOK";
                break;
            case "coroa-sueca":
                $userCurrency = "SEK";
                break;
            case "dolar-americano":
                $userCurrency = "USD";
                break;
            case "dolar-australiano":
                $userCurrency = "AUD";
                break;
            case "dolar-canadense":
                $userCurrency = "CAD";
                break;
            case "dolar-neozelandes":
                $userCurrency = "NZD";
                break;
            case "euro":
                $userCurrency = "EUR";
                break;
            case "franco-suico":
                $userCurrency = "CHF";
                break;
            case "iene":
                $userCurrency = "JPY";
                break;
            case "libra-esterlina":
                $userCurrency = "GBP";
                break;
            case "shekel":
                $userCurrency = "ILS";
                break;
            case "novo-sol":
                $userCurrency = "PEN";
                break;
            case "peso-argentino":
                $userCurrency = "ARS";
                break;
            case "peso-boliviano":
                $userCurrency = "BOB";
                break;
            case "peso-chileno":
                $userCurrency = "CLP";
                break;
            case "peso-colombiano":
                $userCurrency = "COP";
                break;
            case "peso-mexicano":
                $userCurrency = "MXN";
                break;
            case "peso-uruguaio":
                $userCurrency = "UYU";
                break;
            case "rand":
                $userCurrency = "ZAR";
                break;
            case "won":
                $userCurrency = "KRW";
                break;
            case "yuan":
                $userCurrency = "CNY";
                break;
        }
        return $userCurrency;
    }

    /**
     * @param array $args
     * @return array
     */
    public function getStates()
    {
        $db = MysqlClientBuilder::getInstance();
        $adapted = [];
        $query = 'SELECT DISTINCT s.uf FROM cities c, exchange_offices eo, exchange_offices_places eop, states s WHERE eo.status=1 AND eop.exchange_office_id=eo.id AND eop.city_id=c.id AND c.state_id=s.id ORDER BY s.uf';

        try {
            $stmt = $db->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
            $stmt->execute();
            while ($row = $stmt->fetch(PDO::FETCH_NUM, PDO::FETCH_ORI_NEXT)) {
                $adapted[] = [
                    'name' => $row[0],
                ];
            }
            $stmt = null;
        }
        catch (PDOException $e) {
            print $e->getMessage();
        }
        return $adapted;
    }

    /**
     * @param $args
     * @return array
     */
    public function getCities($args)
    {
        $db = MysqlClientBuilder::getInstance();

        $state = $args['state'];
        $productType = $args['productType'];
        $citiesMap = self::citiesNameToSlug();
        $adapted = [];

        $query = 'SELECT DISTINCT c.name FROM cities c, exchange_offices eo, exchange_rates er, states s WHERE eo.status=1 AND s.uf=? AND s.id=c.state_id AND c.id=er.city_id AND eo.id=er.exchange_office_id ORDER BY c.name';

        try {
            $stmt = $db->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
            $stmt->bindParam(1, $state);
            $stmt->execute();
            while ($row = $stmt->fetch(PDO::FETCH_NUM, PDO::FETCH_ORI_NEXT)) {
                $adapted[] = [
                    'name' => $row[0],
                    'slug' => (key_exists($row[0], $citiesMap)) ? $citiesMap[$row[0]] : str_replace('-', ' ', strtoupper($row[0])),
                ];
            }
            $stmt = null;
        }
        catch (PDOException $e) {
            print $e->getMessage();
        }
        return $adapted;
    }

    public static function citiesSlugToName()
    {
        return [
            'sao-paulo' => 'São Paulo',
            'rio-de-janeiro' => 'Rio de Janeiro',
            'belo-horizonte' => 'Belo Horizonte',
            'curitiba' => 'Curitiba',
            'fortaleza' => 'Fortaleza',
            'porto-alegre' => 'Porto Alegre',
            'manaus' => 'Manaus',
            'salvador' => 'Salvador',
            'belem' => 'Belém',
            'goiania' => 'Goiânia',
            'campo-grande' => 'Campo Grande',
            'aracaju' => 'Aracajú',
            'florianopolis' => 'Florianópolis',
            'vitoria' => 'Vitória',
            'campinas' => 'Campinas',
            'sao-bernardo-do-campo' => 'São Bernardo do Campo',
            'santo-andre' => 'Santo André',
            'londrina' => 'Londrina',
        ];
    }

    public static function citiesNameToSlug()
    {
        return [
            'São Paulo' => 'sao-paulo',
            'Rio de Janeiro' => 'rio-de-janeiro',
            'Belo Horizonte' => 'belo-horizonte',
            'Curitiba' => 'curitiba',
            'Fortaleza' => 'fortaleza',
            'Porto Alegre' => 'porto-alegre',
            'Manaus' => 'manaus',
            'Salvador' => 'salvador',
            'Belém' => 'belem',
            'Goiânia' => 'goiania',
            'Campo Grande' => 'campo-grande',
            'Aracajú' => 'aracaju',
            'Florianópolis' => 'florianopolis',
            'Vitória' => 'vitoria',
            'Campinas' => 'campinas',
            'São Bernardo do Campo' => 'sao-bernardo-do-campo',
            'Santo André' => 'santo-andre',
            'Londrina' => 'londrina'
        ];
    }

    public static function currencyData($currency)
    {
        $currencyData = [];            
    
        switch ($currency) {
            case "USD":
                $currencyData['name'] = 'Dólar';
                $currencyData['slug'] = 'dolar-americano';
                $currencyData['currency'] = 'USD';
                $currencyData['imageName'] = 'eua';
                $currencyData['imageTitle'] = 'Estados Unidos';
                $currencyData['order'] = 1;
                $currencyData['precision'] = 3;
                break;
            case "EUR":
                $currencyData['name'] = 'Euro';
                $currencyData['slug'] = 'euro';
                $currencyData['currency'] = 'EUR';
                $currencyData['imageName'] = 'euro';
                $currencyData['imageTitle'] = 'Europa';
                $currencyData['order'] = 2;
                $currencyData['precision'] = 3;
                break;
            case "GBP":
                $currencyData['name'] = 'Libra Esterlina';
                $currencyData['slug'] = 'libra-esterlina';
                $currencyData['currency'] = 'GBP';
                $currencyData['imageName'] = 'gra-bretanha';
                $currencyData['imageTitle'] = 'Grã Bretanha';
                $currencyData['order'] = 3;
                $currencyData['precision'] = 3;
                break;
            case "CAD":
                $currencyData['name'] = 'Dólar Canadense';
                $currencyData['slug'] = 'dolar-canadense';
                $currencyData['currency'] = 'CAD';
                $currencyData['imageName'] = 'canada';
                $currencyData['imageTitle'] = 'Canadá';
                $currencyData['order'] = 4;
                $currencyData['precision'] = 3;
                break;
            case "AUD":
                $currencyData['name'] = 'Dólar Australiano';
                $currencyData['slug'] = 'dolar-australiano';
                $currencyData['currency'] = 'AUD';
                $currencyData['imageName'] = 'australia';
                $currencyData['imageTitle'] = 'Austrália';
                $currencyData['order'] = 5;
                $currencyData['precision'] = 3;
                break;
            case "NZD":
                $currencyData['name'] = 'Dólar Neozelandês';
                $currencyData['slug'] = 'dolar-neozelandes';
                $currencyData['currency'] = 'NZD';
                $currencyData['imageName'] = 'nova-zelandia';
                $currencyData['imageTitle'] = 'Nova Zelândia';
                $currencyData['order'] = 6;
                $currencyData['precision'] = 3;
                break;
            case "ARS":
                $currencyData['name'] = 'Peso Argentino';
                $currencyData['slug'] = 'peso-argentino';
                $currencyData['currency'] = 'ARS';
                $currencyData['imageName'] = 'argentina';
                $currencyData['imageTitle'] = 'Argentina';
                $currencyData['order'] = 7;
                $currencyData['precision'] = 3;
                break;
            case "CLP":
                $currencyData['name'] = 'Peso Chileno';
                $currencyData['slug'] = 'peso-chileno';
                $currencyData['currency'] = 'CLP';
                $currencyData['imageName'] = 'chile';
                $currencyData['imageTitle'] = 'Chile';
                $currencyData['order'] = 8;
                $currencyData['precision'] = 4;
                break;
            case "MXN":
                $currencyData['name'] = 'Peso Mexicano';
                $currencyData['slug'] = 'peso-mexicano';
                $currencyData['currency'] = 'MXN';
                $currencyData['imageName'] = 'mexico';
                $currencyData['imageTitle'] = 'México';
                $currencyData['order'] = 9;
                $currencyData['precision'] = 3;
                break;
            case "COP":
                $currencyData['name'] = 'Peso Colombiano';
                $currencyData['slug'] = 'peso-colombiano';
                $currencyData['currency'] = 'COP';
                $currencyData['imageName'] = 'colombia';
                $currencyData['imageTitle'] = 'Colômbia';
                $currencyData['order'] = 10;
                $currencyData['precision'] = 4;
                break;
            case "UYU":
                $currencyData['name'] = 'Peso Uruguaio';
                $currencyData['slug'] = 'peso-uruguaio';
                $currencyData['currency'] = 'UYU';
                $currencyData['imageName'] = 'uruguai';
                $currencyData['imageTitle'] = 'Uruguai';
                $currencyData['order'] = 11;
                $currencyData['precision'] = 3;
                break;
            case "CHF":
                $currencyData['name'] = 'Franco Suíço';
                $currencyData['slug'] = 'franco-suico';
                $currencyData['currency'] = 'CHF';
                $currencyData['imageName'] = 'suica';
                $currencyData['imageTitle'] = 'Suíça';
                $currencyData['order'] = 12;
                $currencyData['precision'] = 3;
                break;
            case "JPY":
                $currencyData['name'] = 'Iene Japonês';
                $currencyData['slug'] = 'iene';
                $currencyData['currency'] = 'JPY';
                $currencyData['imageName'] = 'japao';
                $currencyData['imageTitle'] = 'Japão';
                $currencyData['order'] = 13;
                $currencyData['precision'] = 3;
                break;
            case "CNY":
                $currencyData['name'] = 'Yuan Chinês';
                $currencyData['slug'] = 'yuan';
                $currencyData['currency'] = 'CNY';
                $currencyData['imageName'] = 'china';
                $currencyData['imageTitle'] = 'China';
                $currencyData['order'] = 14;
                $currencyData['precision'] = 3;
                break;
            case "ZAR":
                $currencyData['name'] = 'Rand Sul-Africano';
                $currencyData['slug'] = 'rand';
                $currencyData['currency'] = 'ZAR';
                $currencyData['imageName'] = 'africa-sul';
                $currencyData['imageTitle'] = 'África do Sul';
                $currencyData['order'] = 15;
                $currencyData['precision'] = 3;
                break;
            case "DKK":
                $currencyData['name'] = 'Coroa Dinamarquesa';
                $currencyData['slug'] = 'coroa-dinamarquesa';
                $currencyData['currency'] = 'DKK';
                $currencyData['imageName'] = 'dinamarca';
                $currencyData['imageTitle'] = 'Dinamarca';
                $currencyData['order'] = 16;
                $currencyData['precision'] = 3;
                break;
            case "NOK":
                $currencyData['name'] = 'Coroa Norueguesa';
                $currencyData['slug'] = 'coroa-norueguesa';
                $currencyData['currency'] = 'NOK';
                $currencyData['imageName'] = 'noruega';
                $currencyData['imageTitle'] = 'Noruega';
                $currencyData['order'] = 17;
                $currencyData['precision'] = 3;
                break;
            case "SEK":
                $currencyData['name'] = 'Coroa Sueca';
                $currencyData['slug'] = 'coroa-sueca';
                $currencyData['currency'] = 'SEK';
                $currencyData['imageName'] = 'suecia';
                $currencyData['imageTitle'] = 'Suécia';
                $currencyData['order'] = 18;
                $currencyData['precision'] = 3;
                break;
            case "KRW":
                $currencyData['name'] = 'Won Sul-Coreano';
                $currencyData['slug'] = 'won';
                $currencyData['currency'] = 'KRW';
                $currencyData['imageName'] = 'coreia-sul';
                $currencyData['imageTitle'] = 'Coréia do Sul';
                $currencyData['order'] = 19;
                $currencyData['precision'] = 4;
                break;
            case "BOB":
                $currencyData['name'] = 'Peso Boliviano';
                $currencyData['slug'] = 'peso-boliviano';
                $currencyData['currency'] = 'BOB';
                $currencyData['imageName'] = 'bolivia';
                $currencyData['imageTitle'] = 'Bolívia';
                $currencyData['order'] = 20;
                $currencyData['precision'] = 3;
                break;
            case "PEN":
                $currencyData['name'] = 'Novo Sol Peruano';
                $currencyData['slug'] = 'novo-sol';
                $currencyData['currency'] = 'PEN';
                $currencyData['imageName'] = 'peru';
                $currencyData['imageTitle'] = 'Peru';
                $currencyData['order'] = 21;
                $currencyData['precision'] = 3;
                break;
            case "ILS":
                $currencyData['name'] = 'Novo Shekel Israelense';
                $currencyData['slug'] = 'shekel';
                $currencyData['currency'] = 'ILS';
                $currencyData['imageName'] = 'israel';
                $currencyData['imageTitle'] = 'Israel';
                $currencyData['order'] = 22;
                $currencyData['precision'] = 3;
        }
        return $currencyData;
    }


    /**
     * @param $args
     * @return array
     */
    public function getCurrencies($args)
    {
        $db = MysqlClientBuilder::getInstance();

        $currencies = [];
        $city = $args['city'];
        $productType = $args['productType'];

        $query = 'SELECT DISTINCT cr.currency FROM cities c, currencies cr, exchange_offices eo, exchange_rates er WHERE eo.status=1 AND c.name=? AND cr.id=er.currency_id AND c.id=er.city_id AND eo.id=er.exchange_office_id ORDER BY cr.sort';

        $citiesMap = self::citiesSlugToName();
        $cityName = (key_exists($city, $citiesMap)) ? $citiesMap[$city] : str_replace('-', ' ', strtoupper($city));

        try {
            $stmt = $db->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
            $stmt->bindParam(1, $cityName);
            $stmt->execute();
            while ($row = $stmt->fetch(PDO::FETCH_NUM, PDO::FETCH_ORI_NEXT)) {
                if(!is_null($row[0])) {
                    $currency = $row[0];
                    $currencies[] = self::currencyData($currency);
                }
            }
            $stmt = null;
        }
        catch (PDOException $e) {
            print $e->getMessage();
        }
        return $currencies;
    }

    /**
     * @param array $data
     * @param string $collectionName
     */
    public function saveData($data, $collectionName)
    {
        $database = DatabaseClientBuilder::getInstance();
        $collection = $database->selectCollection($collectionName);

        $collection->insertOne($data);
    }

    /**
     * @param $data
     * @throws \phpmailerException
     */
    public function sendProposal(&$data)
    {
        foreach ($data['exchangeRates'] as $exchangeRate) {
            if ($exchangeRate['checked']) {
                $exchangeOffice = ExchangeOfficeConfig::get($exchangeRate['exchangeOffice']['nickname']);
                if ($this->mailer->validateAddress($exchangeOffice->getEmail())) {
                    if ($this->debugMode) {
                        $this->logger->addInfo("debugMode: addBCC ", [
                            'nickname' => $exchangeOffice->getNickname(), 'email' => $exchangeOffice->getEmail()
                        ]);
                    } else {
                        $this->mailer->addBCC($exchangeOffice->getEmail(), $exchangeOffice->getName());
                    }
                } else {
                    if (empty($exchangeOffice->getEmail())) {
                        $this->logger->addInfo("undefined email", ['nickname' => $exchangeOffice->getNickname()]);
                    } else {
                        $this->logger->addInfo("invalid email", ['nickname' => $exchangeOffice->getNickname()]);
                    }
                }
            }
        }

        $emailTo = "contato@instacambio.com.br";
        $this->mailer->Host = 'smtp.gmail.com';
        $this->mailer->Port = 465;
        $this->mailer->isSMTP();
        $this->mailer->SMTPDebug = 1;
        $logger = $this->logger;
        $this->mailer->Debugoutput = function ($message, $level) use ($logger) {
            $logger->addDebug("mailer.level:{$level} " . $message);
        };
        $this->mailer->SMTPAuth = true;
        $this->mailer->SMTPSecure = 'ssl';
        $this->mailer->Username = $emailTo;
        $this->mailer->Password = 'Portalinstacambio1620';

        $this->mailer->CharSet = 'UTF-8';
        $this->mailer->From = $emailTo;
        $this->mailer->FromName = 'instaCâmbio';
        $this->mailer->Subject = 'Proposta de cotação';

        $currencyName = $this->currencySymbolToCurrencyName($this->currencySlugToCurrencySymbol($data['currency']));
        $message = 'Olá!' . PHP_EOL . PHP_EOL;
        $message .= 'Recebemos a seguinte solicitação através de nosso site para compra de ' . $currencyName . ' por R$ ' . $data['targetRate'] . PHP_EOL . PHP_EOL;

        $message .= 'Nome: ' . $data['name'] . PHP_EOL;
        $message .= 'Email: ' . $data['email'] . PHP_EOL;
        $message .= 'Telefone: ' . $data['cellphone'] . PHP_EOL;
        $message .= 'Cidade/Estado: ' . $data['city'] . ' / ' . $data['state'] . PHP_EOL;
        $message .= 'Quantidade: ' . number_format($data['quantity'], 0, ',', '.') . PHP_EOL . PHP_EOL;

        $message .= 'Atenciosamente,' . PHP_EOL;
        $message .= 'Equipe Instacâmbio  - https://www.instacambio.com.br' . PHP_EOL;
        $message .= 'Contato: contato@instacambio.com.br' . PHP_EOL . PHP_EOL;
        $this->mailer->Body = $message;
        $this->mailer->SMTPOptions = array(
            'ssl' => array(
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true
            )
        );
        $this->mailer->addAddress($emailTo);
        $this->mailer->addCC($data['email']);

        $copyDataForContext = $data;
        unset($copyDataForContext['exchangeRates']);
        if (!$this->mailer->send()) {
            $this->logger->addError("error when sending email", $copyDataForContext);
        }
    }

    public function currencySymbolToCurrencyName($userCurrency)
    {
        return self::currencySymbolToCurrencyNameStatic($userCurrency);
    }

    public static function currencySymbolToCurrencyNameStatic($userCurrency)
    {
        $currencyName = '';
        switch ($userCurrency) {
            case "DKK":
                $currencyName = "Coroa Dinamarquesa";
                break;
            case "NOK":
                $currencyName = "Coroa Norueguesa";
                break;
            case "SEK":
                $currencyName = "Coroa Sueca";
                break;
            case "USD":
                $currencyName = "Dólar Americano";
                break;
            case "AUD":
                $currencyName = "Dólar Australiano";
                break;
            case "CAD":
                $currencyName = "Dólar Canadense";
                break;
            case "NZD":
                $currencyName = "Dólar Neozelandês";
                break;
            case "EUR":
                $currencyName = "Euro";
                break;
            case "CHF":
                $currencyName = "Franco Suíço";
                break;
            case "JPY":
                $currencyName = "Iene Japonês";
                break;
            case "GBP":
                $currencyName = "Libra Esterlina";
                break;
            case "ILS":
                $currencyName = "Novo Shekel Israelense";
                break;
            case "PEN":
                $currencyName = "Novo Sol Peruano";
                break;
            case "ARS":
                $currencyName = "Peso Argentino";
                break;
            case "BOB":
                $currencyName = "Peso Boliviano";
                break;
            case "CLP":
                $currencyName = "Peso Chileno";
                break;
            case "COP":
                $currencyName = "Peso Colombiano";
                break;
            case "MXN":
                $currencyName = "Peso Mexicano";
                break;
            case "UYU":
                $currencyName = "Peso Uruguaio";
                break;
            case "ZAR":
                $currencyName = "Rand Sul-Africano";
                break;
            case "KRW":
                $currencyName = "Won Sul-Coreano";
                break;
            case "CNY":
                $currencyName = "Yuan Chinês";
                break;
        }
        return $currencyName;
    }

    /**
     * @param $data
     * @throws \phpmailerException
     */
    public function sendContact($data)
    {
        $emailTo = "contato@instacambio.com.br";
        $this->mailer->Host = 'smtp.gmail.com';
        $this->mailer->Port = 465;
        $this->mailer->isSMTP();
        $this->mailer->SMTPDebug = 1;
        $logger = $this->logger;
        $this->mailer->Debugoutput = function ($message, $level) use ($logger) {
            $logger->addDebug("mailer.level:{$level} " . $message);
        };
        $this->mailer->SMTPAuth = true;
        $this->mailer->SMTPSecure = 'ssl';
        $this->mailer->Username = $emailTo;
        $this->mailer->Password = 'Portalinstacambio1620';

        $this->mailer->CharSet = 'UTF-8';
        $this->mailer->From = $emailTo;
        $this->mailer->FromName = 'instaCâmbio';
        $this->mailer->Subject = 'Contato - instaCâmbio';

        $message = 'Olá!' . PHP_EOL . PHP_EOL;

        $message .= 'Está mensagem foi submetida pelo formulário de contato do site.' . PHP_EOL . PHP_EOL;

        $message .= 'Nome: ' . $data['name'] . PHP_EOL;
        $message .= 'Email: ' . $data['email'] . PHP_EOL;
        $message .= 'Telefone: ' . $data['cellphone'] . PHP_EOL;
        $message .= 'Como nos conheceu: ' . $data['whereUsMet'] . PHP_EOL;
        $message .= 'Informações adicionais: ' . $data['additionalInformation'] . PHP_EOL . PHP_EOL;

        $this->mailer->Body = $message;
        $this->mailer->SMTPOptions = array(
            'ssl' => array(
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true
            )
        );
        $this->mailer->addAddress($emailTo);
        $this->mailer->addCC($data['email']);

        if (!$this->mailer->send()) {
            $this->logger->addError("error when sending email", $data);
        }
    }

}
