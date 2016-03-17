<?php
/**
 * Created by PhpStorm.
 * User: Jenner
 * Date: 2016/3/17
 * Time: 21:02
 */

require dirname(__DIR__) . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php';

$urls = file(dirname(__DIR__) . DIRECTORY_SEPARATOR . 'resource' . DIRECTORY_SEPARATOR . 'refer.log');
$spider = new \jenner\redis\study\spider\Spider($urls);
$spider->start();