<?php
/**
 * Created by PhpStorm.
 * User: huyanping
 * Date: 16/8/16
 * Time: 下午4:53
 */

// 生产者
$redis = new Redis();
$redis->connect('127.0.0.1');

while (true) {
    $redis->lPush("queue", mt_rand(0, 10000));
}