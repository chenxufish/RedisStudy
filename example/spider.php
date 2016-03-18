<?php
/**
 * Created by PhpStorm.
 * User: Jenner
 * Date: 2016/3/17
 * Time: 21:02
 */

declare(ticks = 1);
require dirname(__DIR__) . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php';

$refer_file = dirname(__DIR__) . DIRECTORY_SEPARATOR . 'resource' . DIRECTORY_SEPARATOR . 'refer.log';

$producer = new \jenner\redis\study\spider\Producer($refer_file);
$producer->start();
$producer->wait();

$pool = new \Jenner\SimpleFork\Pool();
for ($i = 0; $i < 100; $i++) {
    $spider = new \jenner\redis\study\spider\Spider();
    $pool->execute($spider);
}

$pool->wait();
