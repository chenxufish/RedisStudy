<?php
/**
 * Created by PhpStorm.
 * User: Jenner
 * Date: 2016/3/19
 * Time: 10:09
 */

namespace jenner\redis\study\pubsub;


class Publisher
{
    protected $redis;

    const KEY = "pubsub-demo";

    public function __construct()
    {
        $this->redis = new \Redis();
        $this->redis->connect("127.0.0.1", 6379);
        $this->redis->select(4);
    }

    public function publish() {
        $count = 10;
        for($i = 0; $i<$count; $i++) {
            $this->redis->publish(self::KEY, mt_rand(0, 10000));
        }
    }
}