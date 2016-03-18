<?php
/**
 * Created by PhpStorm.
 * User: Jenner
 * Date: 2016/3/18
 * Time: 10:40
 */

require dirname(__DIR__) . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php';

$lua = new \jenner\redis\study\lua\Lua();

$lua->set("hello", "37wan");
$lua->getAndSet("hello", "37");