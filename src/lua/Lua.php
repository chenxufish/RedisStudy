<?php
/**
 * Created by PhpStorm.
 * User: Jenner
 * Date: 2016/3/18
 * Time: 10:27
 */

namespace jenner\redis\study\lua;


use jenner\redis\study\tool\Logger;

class Lua
{
    protected $redis;

    public function __construct()
    {
        $this->redis = new \Redis();
        $this->redis->connect("127.0.0.1", 6379);
        $this->redis->select(2);
    }

    public function set($key, $value)
    {
        return $this->redis->set($key, $value);
    }

    public function getAndSet($key, $value)
    {
        $lua = <<<GLOB_MARK
local value = redis.call('get', KEYS[1])
redis.call('set', KEYS[1], ARGV[1])
return value
GLOB_MARK;
        $result = $this->redis->eval($lua, array($key, $value), 1);
        Logger::info("eval script result:" . var_export($result, true));
    }

    public function error()
    {
        return $this->redis->getLastError();
    }
}