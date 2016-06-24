<?php

use br\com\InstaCambio\Webservice;
use br\com\InstaCambio\Webservice\RestApplication;
use Illuminate\Database\Query\Builder;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Slim\App;
use Slim\Container;
use Slim\Http\Request;
use Slim\Http\Response;
use Slim\HttpCache\Cache;
use Slim\HttpCache\CacheProvider;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\GetSetMethodNormalizer;
use Symfony\Component\Serializer\Serializer;

require dirname(__FILE__) . DIRECTORY_SEPARATOR . 'src' . DIRECTORY_SEPARATOR . 'bootstrap.php';

$parsedConfiguration = parse_ini_file(dirname(ROOT_DIR) . DIRECTORY_SEPARATOR . 'app.ini');
$configuration = [
    'settings' => [
        // Slim Settings
        'determineRouteBeforeAppMiddleware' => false,
        'displayErrorDetails' => true,
        'db' => [
            'driver' => 'mysql',
            'host' => 'localhost',
            'database' => 'admin_instacambio',
            'username' => $parsedConfiguration['db.user'],
            'password' => $parsedConfiguration['db.pass'],
            'charset' => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix' => '',
        ]
    ],
];
$container = new Container($configuration);
// Service factory for the ORM
$container['db'] = function ($container) {
    $capsule = new \Illuminate\Database\Capsule\Manager;
    $capsule->addConnection($container['settings']['db']);

    $capsule->setAsGlobal();
    $capsule->bootEloquent();

    return $capsule;
};
$container['serializer'] = function () {
    $normalizer = new GetSetMethodNormalizer();
    return new Serializer([$normalizer], [new JsonEncoder()]);
};
$container['webServiceRestApplication'] = function () {
    $filename = __DIR__ . DS . 'debug_mode';
    $debugMode = false;
    if (file_exists($filename)) {
        $debugMode = (boolean)file_get_contents($filename);
    }
    $restApplication = new RestApplication($debugMode);
    return $restApplication;
};
$container['cache'] = function () {
    return new CacheProvider();
};
$container['serializationOptions'] = ['json_encode_options' => JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES];

$app = new App($container);
$app->add(new Cache('private', 86400, true));

$app->get('/v1/quotation/{city}/{currency}/{trade}/{delivery}/{productType}', function (Request $request, Response $response, $args) {
    /* @var $restApplication RestApplication */
    $restApplication = $this->webServiceRestApplication;
    $exchangeRates = $restApplication->getExchangeRates($args);

    /* @var $cache CacheProvider */
    $cache = $this->cache;
    $response = $cache->denyCache($response);

    /* @var $serializer Serializer */
    $serializer = $this->serializer;
    $response
        ->getBody()
        ->write($serializer->serialize($exchangeRates, 'json', $this->serializationOptions));

    return $response->withHeader('Content-Type', 'application/json; charset=utf-8');
});
$app->get('/v1/states', function (Request $request, Response $response) {
    /* @var $restApplication RestApplication */
    $restApplication = $this->webServiceRestApplication;
    $args = ['productType' => 'foreignCurrency'];
    $states = $restApplication->getStates($args);

    /* @var $serializer Serializer */
    $serializer = $this->serializer;
    $body = $serializer->serialize($states, 'json', $this->serializationOptions);

    /* @var $cache CacheProvider */
    $cache = $this->cache;
    # 1 Week for cache = 60 seconds * 60 minutes * 24 hours * 7 days
    $response = $cache->allowCache($response, 'public', 604800, true);
    $response = $cache->withEtag($response, md5($body));

    $response
        ->getBody()
        ->write($body);

    return $response
        ->withHeader('Content-Type', 'application/json; charset=utf-8');
});
$app->get('/v1/cities/{state}', function (Request $request, Response $response, $args) {
    /* @var $restApplication RestApplication */
    $restApplication = $this->webServiceRestApplication;
    $args['productType'] = 'foreignCurrency';
    $cities = $restApplication->getCities($args);

    /* @var $serializer Serializer */
    $serializer = $this->serializer;
    $body = $serializer->serialize($cities, 'json', $this->serializationOptions);

    /* @var $cache CacheProvider */
    $cache = $this->cache;
    # 1 Week for cache in seconds = 60 seconds * 60 minutes * 24 hours * 7 days
    $response = $cache->allowCache($response, 'public', 604800, true);
    $response = $cache->withEtag($response, md5($body));

    $response
        ->getBody()
        ->write($body);

    return $response
        ->withHeader('Content-Type', 'application/json; charset=utf-8');
});
$app->get('/v1/currencies/{city}', function (Request $request, Response $response, $args) {
    /* @var $restApplication RestApplication */
    $restApplication = $this->webServiceRestApplication;
    $args['productType'] = 'foreignCurrency';
    $currencies = $restApplication->getCurrencies($args);


    /* @var $serializer Serializer */
    $serializer = $this->serializer;
    $body = $serializer->serialize($currencies, 'json', $this->serializationOptions);

    /* @var $cache CacheProvider */
    $cache = $this->cache;
    # 1 Week for cache = 60 seconds * 60 minutes * 24 hours * 7 days
    $response = $cache->allowCache($response, 'public', 604800, true);
    $response = $cache->withEtag($response, md5($body));

    $response
        ->getBody()
        ->write($body);

    return $response
        ->withHeader('Content-Type', 'application/json; charset=utf-8');
});
$app->post('/v1/notifications', function (Request $request, Response $response) {
    $data = $request->getParsedBody();
    $data['sent'] = false;
    /* @var $restApplication RestApplication */
    $restApplication = $this->webServiceRestApplication;
    $restApplication->saveData($data, 'notifications');

    /* @var $serializer Serializer */
    $serializer = $this->serializer;
    $response
        ->getBody()
        ->write($serializer->serialize(['success' => true, 'message' => 'Alerta salvo com sucesso.'], 'json', $this->serializationOptions));

    return $response
        ->withHeader('Content-Type', 'application/json; charset=utf-8');
});
$app->post('/v1/proposals', function (Request $request, Response $response) {
    $data = $request->getParsedBody();
    /* @var $restApplication RestApplication */
    $restApplication = $this->webServiceRestApplication;
    $restApplication->sendProposal($data);
    $restApplication->saveData($data, 'proposals');

    /* @var $serializer Serializer */
    $serializer = $this->serializer;
    $response
        ->getBody()
        ->write($serializer->serialize(['success' => true, 'message' => 'Proposta salva com sucesso.'], 'json', $this->serializationOptions));

    return $response
        ->withHeader('Content-Type', 'application/json; charset=utf-8');
});
$app->post('/v1/contacts', function (Request $request, Response $response) {
    $data = $request->getParsedBody();
    /* @var $restApplication RestApplication */
    $restApplication = $this->webServiceRestApplication;
    $restApplication->sendContact($data);
    $restApplication->saveData($data, 'contacts');

    /* @var $serializer Serializer */
    $serializer = $this->serializer;
    $response
        ->getBody()
        ->write($serializer->serialize(['success' => true, 'message' => 'Mensagem enviada com sucesso.'], 'json', $this->serializationOptions));

    return $response
        ->withHeader('Content-Type', 'application/json; charset=utf-8');
});
$app->post('/v1/metadata', function (Request $request, Response $response) {
    $data = $request->getParsedBody();
    /* @var  $table Builder */
    $table = $this->db->table('metadata');
    $record = $table->where('friendly_path', '=', $data['friendlyPath'])->first(['title', 'description']);

    if (empty($record)) {
        $logger = new Logger('logger');
        $logger->pushHandler(new StreamHandler(ROOT_DIR . DIRECTORY_SEPARATOR . 'tmp' . DIRECTORY_SEPARATOR . 'logs' . DIRECTORY_SEPARATOR . 'metadata.log', Logger::NOTICE, false, 0777));
        $logger->addNotice("metadata was not found", ['friendly_path' => $data['friendlyPath']]);
    }

    /* @var $serializer Serializer */
    $serializer = $this->serializer;
    $body = $serializer->serialize((array)$record, 'json', $this->serializationOptions);

    /* @var $cache CacheProvider */
    $cache = $this->cache;
    # 1 Week for cache = 60 seconds * 60 minutes * 24 hours * 7 days
    $response = $cache->allowCache($response, 'public', 604800, true);
    $response = $cache->withEtag($response, md5($body));

    $response
        ->getBody()
        ->write($body);

    return $response
        ->withHeader('Content-Type', 'application/json; charset=utf-8');
});
$app->run();