<?php

namespace App\Util\Log;

class LoggerFactory
{
    /**
     * TODO 可写配置文件
     * @var string[]
     */
    public static $classMap = [
        'log4php' => Log4php::class,
        'think-log' => ThinkLog::class,
    ];

    /**
     * 单例
     * @param string $type
     * @return mixed
     * @throws \Exception
     */
    public static function factory($type = 'log4php')
    {
        if(isset(self::$classMap[$type])){
            return self::$classMap[$type]::getInstance();
        }
        throw new \Exception('类型错误',500);
    }
}