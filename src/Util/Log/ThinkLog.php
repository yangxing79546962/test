<?php

namespace App\Util\Log;

use think\facade\Log;


class ThinkLog implements LogInterface
{
    private static $instance;

    private function __construct(){}

    private function __clone(){}

    public static function getInstance()
    {
        if (null == self::$instance) {
            self::$instance = new ThinkLog();
        }
        Log::init([
            'default'  => 'file',
            'channels' => [
                'file' => [
                    'type' => 'file',
                    'path' => '/runtime/logs/',
                ],
            ],
        ]);

        return self::$instance;
    }

    public function info(string $message)
    {
        Log::info(strtoupper($message));
    }

    public function debug(string $message)
    {
        Log::debug(strtoupper($message));
    }

    public function error(string $message)
    {
        Log::error(($message));
    }
}