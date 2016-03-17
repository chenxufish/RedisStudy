<?php
/**
 * Created by PhpStorm.
 * User: Jenner
 * Date: 2016/3/17
 * Time: 21:36
 */

namespace jenner\redis\study\spider;


use jenner\redis\study\tool\Logger;
use Jenner\SimpleFork\Process;
use Jenner\SimpleFork\Queue\RedisQueue;

class Producer extends Process
{
    protected $queue;
    protected $log;

    public function __construct($log)
    {
        parent::__construct(null, null);
        $this->log = $log;
        $this->queue = new RedisQueue('127.0.0.1', 6379, 2, 'spider-queue');
    }

    public function run() {
        $urls = file($this->log);
        Logger::info("producer start");
        foreach($urls as $url) {
            $this->queue->put(trim($url));
        }
        Logger::info("producer stop");
    }
}