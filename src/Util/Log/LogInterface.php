<?php

namespace App\Util\Log;

interface LogInterface
{
    public function info(string $message);

    public function debug(string $message);

    public function error(string $message);
}