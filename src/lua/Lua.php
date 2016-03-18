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

    public function getAndSet($key, $value) {
        $lua = <<<GLOB_MARK
local value = redis.call('get', KEY[1])
redis.call('set', ARGV[1])
return value
GLOB_MARK;
        $result = $this->redis->eval($lua, array($key, $value), 1);
        Logger::info("eval script result:" . var_export($result, true));
    }
}