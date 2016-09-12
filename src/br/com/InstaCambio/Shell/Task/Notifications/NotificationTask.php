<?php

namespace br\com\InstaCambio\Shell\Task\Notifications;

use br\com\InstaCambio\Config\Database\DatabaseClientBuilder;
use br\com\InstaCambio\Model\ExchangeRate;
use br\com\InstaCambio\Webservice\RestApplication;
use MongoDB\Model\BSONDocument;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;

class NotificationTask
{
    /**
     * @var \PHPMailer
     */
    private $mailer;
    /**
     * @var bool
     */
    private $debugMode;

    /**
     * @var Logger
     */
    private $logger;

    public function __construct($debugMode = false)
    {
        $this->mailer = new \PHPMailer();
        $this->logger = new Logger('notificationLogger');
        $this->logger->pushHandler(new StreamHandler(ROOT_DIR . DS . 'tmp' . DS . 'logs' . DS . 'mailer.log', Logger::INFO, false, 0777));
        $this->debugMode = $debugMode;
    }

    public function execute()
    {
        $timeBegin = microtime(true);
        $notificationCollection = DatabaseClientBuilder::getInstance()->selectCollection('notifications');
        $notifications = $notificationCollection->find(['sent' => false]);
        $exchangeRateCollection = DatabaseClientBuilder::getInstance()->selectCollection('exchangeRates');
        $notificationsAttended = new \ArrayObject([]);
        $acceptableDate = (new \DateTime());
        $acceptableDate->sub(new \DateInterval('P5D'));
        foreach ($notifications as $index => $notification) {
            /** @var ExchangeRate[] $exchangeRates */
            $exchangeRates = $exchangeRateCollection->find([
                'exchangeOffice.state' => $notification['state'],
                'exchangeOffice.city' => $notification['city'],
                /**
                 * @todo A plataforma não oferece ao usuário as taxas de câmbio para cartão pré-pago.
                 * @todo O field 'productType' deve ser adicionado quando cartão pré-pago for oferecido.
                 */
                'productType' => 'foreignCurrency',
                'currency' => RestApplication::currencySlugToCurrencySymbolStatic($notification['currency']),
                'update' => ['$gt' => $acceptableDate->format('c')]
            ]);
            foreach ($exchangeRates as $exchangeRate) {
                if ($exchangeRate->getTotalPrice() <= $notification['rate']) {
                    $notification['sent'] = true;
                    $notificationCollection->updateOne(['_id' => $notification['_id']], ['$set' => $notification]);
                    $notificationsAttended->append($notification);
                    break;
                }
            }
        }

        foreach ($notificationsAttended as $index => $notification) {
            /** @var $notification BSONDocument */
            $this->sendMailNotification($notification->getArrayCopy());
        }
        $timeSpent = microtime(true) - $timeBegin;
        $this->logger->addInfo("time spent for send email was {$timeSpent} (seconds)");

        return $notificationsAttended;
    }

    public function sendMailNotification($notification)
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
        $this->mailer->Subject = 'Alerta de câmbio - instaCâmbio';

        $message = "Olá {$notification['name']}!" . PHP_EOL . PHP_EOL;

        $message .= 'Sua taxa de câmbio desejada acabou de ser atendida. Que tal comprar agora?' . PHP_EOL . PHP_EOL;

        $message .= 'Acesse https://www.instacambio.com.br e faça sua proposta:' . PHP_EOL . PHP_EOL;
        $message .= "Taxa desejada: R$ {$notification['rate']}" . PHP_EOL;
        $message .= 'Moeda: ' . RestApplication::currencySymbolToCurrencyNameStatic(RestApplication::currencySlugToCurrencySymbolStatic($notification['currency'])) . PHP_EOL;
        $humanReadableCity = RestApplication::citiesNameToSlug()[$notification['city']];
        $message .= "Cidade/Estado: {$humanReadableCity}/{$notification['state']}" . PHP_EOL . PHP_EOL;

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

        if ($this->debugMode) {
            $this->logger->addInfo("debugMode: addAddress ", ['name' => $notification['name']]);
        } else {
            if ($this->mailer->validateAddress($notification['email'])) {
                $this->mailer->addAddress($notification['email']);
            }
            $this->mailer->addBCC($this->mailer->FromName, $this->mailer->From);
        }

        if (!$this->mailer->send()) {
            $this->logger->addError("error when sending email", $notification);
        }
        $this->mailer->clearAllRecipients();
    }

}