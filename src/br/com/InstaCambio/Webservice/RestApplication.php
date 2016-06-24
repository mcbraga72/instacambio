<?php

namespace br\com\InstaCambio\Webservice;

use br\com\InstaCambio\Config\Database\DatabaseClientBuilder;
use br\com\InstaCambio\Model\ExchangeOfficeConfig;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;

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
     * @return \MongoDB\Driver\Cursor
     */
    public function getExchangeRates($args)
    {
        $city = $args['city'];
        $slugCurrency = $args['currency'];
        $tradeInfo = $args['trade'];
        $deliveryOption = $args['delivery'];
        $productType = $args['productType'];
        $acceptableDate = (new \DateTime());
        $acceptableDate->sub(new \DateInterval('P5D'));
        $currencySymbol = $this->currencySlugToCurrencySymbol($slugCurrency);

        $filters = ['exchangeOffice.city' => $city, 'currency' => $currencySymbol];
        if ($tradeInfo === "comprar") {
            $tradeInfo = "buy";
        } else {
            $tradeInfo = "sell";
        }
        $filters['trade'] = $tradeInfo;

        if ($deliveryOption === "delivery") {
            $filters['exchangeOffice.delivery'] = true;
        }

        if ($productType === "papel-moeda") {
            $productType = 'foreignCurrency';
        } else {
            $productType = 'currencyCard';
        }
        $filters['productType'] = $productType;
        $filters['update'] = ['$gt' => $acceptableDate->format('c')];

        $database = DatabaseClientBuilder::getInstance();
        $collection = $database->selectCollection('exchangeRates');
        $results = $collection->find($filters, ['sort' => ['price' => 1]]);
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
            case "iene-japones":
                $userCurrency = "JPY";
                break;
            case "libra-esterlina":
                $userCurrency = "GBP";
                break;
            case "novo-shekel-israelense":
                $userCurrency = "ILS";
                break;
            case "novo-sol-peruano":
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
            case "rand-sul-africano":
                $userCurrency = "ZAR";
                break;
            case "won-sul-coreano":
                $userCurrency = "KRW";
                break;
            case "yuan-chines":
                $userCurrency = "CNY";
                break;
        }
        return $userCurrency;
    }

    /**
     * @param array $args
     * @return array
     */
    public function getStates($args = [])
    {
        $database = DatabaseClientBuilder::getInstance();
        $collection = $database->selectCollection('exchangeRates');

        $adapted = [];
        $states = $collection->distinct("exchangeOffice.state", $args);
        foreach ($states as $index => $result) {
            $adapted[] = [
                'name' => $result,
            ];
        }
        return $adapted;

    }

    /**
     * @param $args
     * @return array
     */
    public function getCities($args)
    {
        $database = DatabaseClientBuilder::getInstance();
        $collection = $database->selectCollection('exchangeRates');

        $filter['exchangeOffice.state'] = $args['state'];
        $filter['productType'] = $args['productType'];
        $cities = $collection->distinct("exchangeOffice.city", $filter);

        $citiesMap = self::citiesMap();
        $adapted = [];
        foreach ($cities as $index => $city) {
            $adapted[] = [
                'slug' => $city,
                'name' => (key_exists($city, $citiesMap)) ? $citiesMap[$city] : str_replace('-', ' ', strtoupper($city)),
            ];
        }
        return $adapted;
    }

    public static function citiesMap()
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

        ];
    }

    /**
     * @param $args
     * @return array
     */
    public function getCurrencies($args)
    {
        $userCity = $args['city'];
        $filter['exchangeOffice.city'] = $userCity;
        $filter['productType'] = $args['productType'];

        $database = DatabaseClientBuilder::getInstance();
        $collection = $database->selectCollection('exchangeRates');

        $results = $collection->distinct("currency", $filter);
        $currencyData = [
            [
                'name' => "Dólar",
                'slug' => "dolar-americano",
                'currency' => 'USD',
                'imageName' => 'eua',
                'imageTitle' => 'Estados Unidos',
                'order' => 1,
                'precision' => 3,
            ],
            [
                'name' => "Euro",
                'slug' => "euro",
                'currency' => 'EUR',
                'imageName' => 'euro',
                'imageTitle' => 'Europa',
                'order' => 2,
                'precision' => 3,
            ],
            [
                'name' => "Libra Esterlina",
                'slug' => "libra-esterlina",
                'currency' => 'GBP',
                'imageName' => 'gra-bretanha',
                'imageTitle' => 'Grã Bretanha',
                'order' => 3,
                'precision' => 3,
            ],
            [
                'name' => "Dólar Canadense",
                'slug' => "dolar-canadense",
                'currency' => 'CAD',
                'imageName' => 'canada',
                'imageTitle' => 'Canadá',
                'order' => 4,
                'precision' => 3,
            ],
            [
                'name' => "Dólar Australiano",
                'slug' => "dolar-australiano",
                'currency' => 'AUD',
                'imageName' => 'australia',
                'imageTitle' => 'Austrália',
                'order' => 5,
                'precision' => 3,
            ],
            [
                'name' => "Dólar Neozelandês",
                'slug' => "dolar-neozelandes",
                'currency' => 'NZD',
                'imageName' => 'nova-zelandia',
                'imageTitle' => 'Nova Zelândia',
                'order' => 6,
                'precision' => 3,
            ],
            [
                'name' => "Peso Argentino",
                'slug' => "peso-argentino",
                'currency' => 'ARS',
                'imageName' => 'argentina',
                'imageTitle' => 'Argentina',
                'order' => 7,
                'precision' => 3,
            ],
            [
                'name' => "Peso Chileno",
                'slug' => "peso-chileno",
                'currency' => 'CLP',
                'imageName' => 'chile',
                'imageTitle' => 'Chile',
                'order' => 8,
                'precision' => 4,
            ],
            [
                'name' => "Peso Mexicano",
                'slug' => "peso-mexicano",
                'currency' => 'MXN',
                'imageName' => 'mexico',
                'imageTitle' => 'México',
                'order' => 9,
                'precision' => 3,
            ],
            [
                'name' => "Peso Colombiano",
                'slug' => "peso-colombiano",
                'currency' => 'COP',
                'imageName' => 'colombia',
                'imageTitle' => 'Colômbia',
                'order' => 10,
                'precision' => 4,
            ],
            [
                'name' => "Peso Uruguaio",
                'slug' => "peso-uruguaio",
                'currency' => 'UYU',
                'imageName' => 'uruguai',
                'imageTitle' => 'Uruguai',
                'order' => 11,
                'precision' => 3,
            ],
            [
                'name' => "Franco Suíço",
                'slug' => "franco-suico",
                'currency' => 'CHF',
                'imageName' => 'suica',
                'imageTitle' => 'Suíça',
                'order' => 12,
                'precision' => 3,
            ],
            [
                'name' => "Iene Japonês",
                'slug' => "iene-japones",
                'currency' => 'JPY',
                'imageName' => 'japao',
                'imageTitle' => 'Japão',
                'order' => 13,
                'precision' => 3,
            ],
            [
                'name' => "Yuan Chinês",
                'slug' => "yuan-chines",
                'currency' => 'CNY',
                'imageName' => 'china',
                'imageTitle' => 'China',
                'order' => 14,
                'precision' => 3,
            ],
            [
                'name' => "Rand Sul-Africano",
                'slug' => "rand-sul-africano",
                'currency' => 'ZAR',
                'imageName' => 'africa-sul',
                'imageTitle' => 'África do Sul',
                'order' => 15,
                'precision' => 3,
            ],
            [
                'name' => "Coroa Dinamarquesa",
                'slug' => "coroa-dinamarquesa",
                'currency' => 'DKK',
                'imageName' => 'dinamarca',
                'imageTitle' => 'Dinamarca',
                'order' => 16,
                'precision' => 3,
            ],
            [
                'name' => "Coroa Norueguesa",
                'slug' => "coroa-norueguesa",
                'currency' => 'NOK',
                'imageName' => 'noruega',
                'imageTitle' => 'Noruega',
                'order' => 17,
                'precision' => 3,
            ],
            [
                'name' => "Coroa Sueca",
                'slug' => "coroa-sueca",
                'currency' => 'SEK',
                'imageName' => 'suecia',
                'imageTitle' => 'Suécia',
                'order' => 18,
                'precision' => 3,
            ],
            [
                'name' => "Won Sul-Coreano",
                'slug' => "won-sul-coreano",
                'currency' => 'KRW',
                'imageName' => 'coreia-sul',
                'imageTitle' => 'Coréia do Sul',
                'order' => 19,
                'precision' => 4,
            ],
            [
                'name' => "Peso Boliviano",
                'slug' => "peso-boliviano",
                'currency' => 'BOB',
                'imageName' => 'bolivia',
                'imageTitle' => 'Bolívia',
                'order' => 20,
                'precision' => 3,
            ],
            [
                'name' => "Novo Sol Peruano",
                'slug' => "novo-sol-peruano",
                'currency' => 'PEN',
                'imageName' => 'peru',
                'imageTitle' => 'Peru',
                'order' => 21,
                'precision' => 3,
            ],
            [
                'name' => "Novo Shekel Israelense",
                'slug' => "novo-shekel-israelense",
                'currency' => 'ILS',
                'imageName' => 'israel',
                'imageTitle' => 'Israel',
                'order' => 22,
                'precision' => 3,
            ],
        ];
        $currencies = [];
        foreach ($currencyData as $currency) {
            if (in_array($currency['currency'], $results))
                $currencies[] = $currency;
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
        $this->mailer->Password = 'Open1001!';

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
        $this->mailer->Password = 'Open1001!';

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
