<?php
/**
 * Created by PhpStorm.
 * User: Jenner
 * Date: 2016/3/17
 * Time: 20:42
 */


declare(ticks = 1);
require dirname(__DIR__) . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php';

$pool = new \Jenner\SimpleFork\Pool();

for ($i = 0; $i < 10; $i++) {
    $producer = new \jenner\redis\study\queue\Producer();
    $pool->execute($producer);
}

for ($i = 0; $i < 10; $i++) {
    $consumer = new \jenner\redis\study\queue\Consumer();
    $pool->execute($consumer);
}

$pool->wait();