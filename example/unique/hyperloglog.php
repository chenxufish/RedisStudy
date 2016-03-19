<?php
/**
 * Created by PhpStorm.
 * User: Jenner
 * Date: 2016/3/19
 * Time: 9:40
 */

require dirname(dirname(__DIR__)) . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php';

$ips = file(dirname(dirname(__DIR__)) . DIRECTORY_SEPARATOR . 'resouce' . DIRECTORY_SEPARATOR . 'ip.log');
$hyper = new \jenner\redis\study\unique\HyperLogLog($ips);
$hyper->start();

$set = new \jenner\redis\study\unique\Set($ips);
$set->start();