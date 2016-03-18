<?php
/**
 * Created by PhpStorm.
 * User: Jenner
 * Date: 2016/3/17
 * Time: 20:51
 */

namespace jenner\redis\study\spider;


use GuzzleHttp\Client;
use jenner\redis\study\tool\Logger;
use Jenner\SimpleFork\Process;
use Jenner\SimpleFork\Queue\RedisQueue;

class Spider extends Process
{
    protected $http;
    protected $queue;
    protected $cache;

    public function __construct()
    {
        parent::__construct(null, null);
        $this->http = new Client();
        $this->queue = new RedisQueue('127.0.0.1', 6379, 2, 'spider-queue');
        $this->cache = new Cache();
    }

    public function run()
    {
        Logger::info("spider start");
        while (true) {
            Logger::info($this->queue->size());
            if ($this->queue->size() == 0) {
                Logger::info("queue is empty");
                break;
            }
            try {
                $url = $this->queue->get();
                if ($this->cache->get($url)) {
                    Logger::info("cached. url:" . $url);
                }
                $response = $this->http->get($url);
                $this->cache->set($url, $response->getBody());
                Logger::info('get body. size:' . strlen($response->getBody()));
            } catch (\Exception $e) {
            }
        }
        Logger::info("spider stop");
    }
}