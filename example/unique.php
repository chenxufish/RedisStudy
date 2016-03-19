<?php
/**
 * Created by PhpStorm.
 * User: Jenner
 * Date: 2016/3/19
 * Time: 9:40
 */

require dirname(__DIR__) . DIRECTORY_SEPARATOR . DIRECTORY_SEPARATOR . 'autoload.php';

$file = dirname(__DIR__) . DIRECTORY_SEPARATOR . 'resource' . DIRECTORY_SEPARATOR . 'ip.log';
$ips = file($file);
array_walk($ips, function(&$value) {
    $value = trim($value);
});

\jenner\redis\study\tool\Logger::info("hyperloglog start");
$hyper = new \jenner\redis\study\unique\HyperLogLog($ips);
$hyper->start();

\jenner\redis\study\tool\Logger::info("set start");
$set = new \jenner\redis\study\unique\Set($ips);
$set->start();