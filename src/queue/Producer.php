<?php
/**
 * Created by PhpStorm.
 * User: Jenner
 * Date: 2016/3/17
 * Time: 20:40
 */

namespace jenner\redis\study\queue;


use Jenner\SimpleFork\Process;
use Jenner\SimpleFork\Queue\RedisQueue;

class Producer extends Process
{
    public function run()
    {
        $queue = new RedisQueue('127.0.0.1', 6379, 1);
        for ($i = 0; $i < 100000; $i++) {
            $queue->put(getmypid() . '-' . mt_rand(0, 1000));
        }
        $queue->close();
    }
}