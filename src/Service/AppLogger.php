<?php

namespace App\Service;

use App\Util\Log\LoggerFactory;

class AppLogger
{

    private $logger;

    public function __construct($type = 'log4php')
    {
        $this->logger = LoggerFactory::factory($type);
    }

    public function info($message = '')
    {
        $this->logger->info($message);
    }

    public function debug($message = '')
    {
        $this->logger->debug($message);
    }

    public function error($message = '')
    {
        $this->logger->error($message);
    }
}