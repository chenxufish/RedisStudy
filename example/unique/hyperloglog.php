<?php
/**
 * Created by PhpStorm.
 * User: Jenner
 * Date: 2016/3/19
 * Time: 9:40
 */

require dirname(dirname(__DIR__)) . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php';

$file = dirname(dirname(__DIR__)) . DIRECTORY_SEPARATOR . 'resource' . DIRECTORY_SEPARATOR . 'ip.log';
$ips = file($file);
array_walk($ips, function($key, &$value) {
    $value = trim($value);
});
$hyper = new \jenner\redis\study\unique\HyperLogLog($ips);
$hyper->start();

exit;
$set = new \jenner\redis\study\unique\Set($ips);
$set->start();