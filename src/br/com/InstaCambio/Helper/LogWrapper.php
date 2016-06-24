<?php

namespace br\com\InstaCambio\Helper;

use Monolog\Logger;

class LogWrapper
{
    /**
     * @var array
     */
    private $logs;

    /**
     * LogWrapper constructor.
     */
    public function __construct()
    {
        $this->logs = [];
    }

    /**
     * @return array
     */
    public function getLogs()
    {
        return $this->logs;
    }

    public function addLog($message, $level = Logger::ERROR, array $context = [])
    {
        $this->logs[$level][] = [$message, $context];
    }
}