<?php
/**
 * Created by PhpStorm.
 * User: Jenner
 * Date: 2016/3/17
 * Time: 20:41
 */

namespace jenner\redis\study\queue;


use Jenner\SimpleFork\Process;
use Jenner\SimpleFork\Queue\RedisQueue;

class Consumer extends Process
{
    public function run()
    {
        $queue = new RedisQueue('127.0.0.1', 6379, 1);
        while (true) {
            $res = $queue->get();
            if ($res !== false) {
                echo $res . PHP_EOL;
            }else{
                break;
            }
        }
    }
}