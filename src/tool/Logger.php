<?php
/**
 * Created by PhpStorm.
 * User: Jenner
 * Date: 2016/3/17
 * Time: 21:39
 */

namespace jenner\redis\study\tool;


class Logger
{
    /**
     * log message to console
     * @param $message
     */
    public static function info($message)
    {
        echo "[" . getmypid() . "]" . $message . PHP_EOL;
    }
}