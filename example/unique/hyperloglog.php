<?php
/**
 * Created by PhpStorm.
 * User: Jenner
 * Date: 2016/3/19
 * Time: 9:40
 */

require dirname(dirname(__DIR__)) . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php';

$file = dirname(dirname(__DIR__)) . DIRECTORY_SEPARATOR . 'resouce' . DIRECTORY_SEPARATOR . 'ip.log' . PHP_EOL;
$ips = file($file);
var_dump($ips);
$hyper = new \jenner\redis\study\unique\HyperLogLog($ips);
$hyper->start();

$set = new \jenner\redis\study\unique\Set($ips);
$set->start();