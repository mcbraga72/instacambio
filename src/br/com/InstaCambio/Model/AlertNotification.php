<?php

namespace br\com\InstaCambio\Model;

class AlertNotification
{

    /**
     * @var string
     */
    private $email;

    /**
     * @var ExchangeRate
     */
    private $message;

    /**
     * AlertNotification constructor.
     * @param string $email
     * @param ExchangeRate $message
     */
    public function __construct($email, $message)
    {
        $this->email = $email;
        $this->message = $message;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @return ExchangeRate
     */
    public function getMessage()
    {
        return $this->message;
    }

}