<?php
/**
 * Created by PhpStorm.
 * User: Jenner
 * Date: 2016/3/17
 * Time: 20:57
 */

namespace jenner\redis\study\spider;


class Cache
{
    protected $redis;

    const PREFIX = "spider-cache-";

    public function __construct()
    {
        $this->redis = new \Redis();
        $this->redis->connect("127.0.0.1", 6379);
        $this->redis->select(2);
        $this->redis->setOption(\Redis::OPT_PREFIX, self::PREFIX);
    }

    public function get($url)
    {
        $key = md5($url);
        return $this->redis->get($key);
    }

    public function set($url, $value)
    {
        $key = md5($url);
        return $this->redis->set($key, $value);
    }
}