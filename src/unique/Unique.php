<?php
/**
 * Created by PhpStorm.
 * User: Jenner
 * Date: 2016/3/17
 * Time: 21:08
 */

namespace jenner\redis\study\unique;


use jenner\redis\study\tool\Logger;

class Unique
{
    protected $redis;
    protected $ips;
    const KEY = "ip-unique";

    public function __construct(array $ips)
    {
        $this->redis = new \Redis();
        $this->redis->connect("127.0.0.1", 6379);
        $this->redis->select(3);


        $this->ips = $ips;
    }

    public function start() {
        Logger::info("unique process start");
        foreach($this->ips as $ip) {
            $this->redis->pfadd(self::KEY, $ip);
        }

        echo $this->redis->pfcount();
        Logger::info("unique done. ip count:" . $this->redis->pfcount());
    }


}