<?php
/**
 * Created by PhpStorm.
 * User: Jenner
 * Date: 2016/3/17
 * Time: 21:08
 */

namespace jenner\redis\study\unique;


use jenner\redis\study\tool\Logger;

class HyperLogLog
{
    /**
     * @var \Redis
     */
    protected $redis;
    /**
     * @var array
     */
    protected $ips;
    /**
     * default hyperloglog key
     */
    const KEY = "ip-unique-hyperloglog";

    /**
     * HyperLogLog constructor.
     * @param array $ips
     */
    public function __construct(array $ips)
    {
        $this->redis = new \Redis();
        $this->redis->connect("127.0.0.1", 6379);
        $this->redis->select(3);

        $this->ips = $ips;
    }

    /**
     * start to count ips using hyperloglog
     */
    public function start()
    {
        Logger::info("unique process start");
        $this->redis->pfadd(self::KEY, $this->ips);

        Logger::info("unique done. ip count:" . $this->redis->pfcount(self::KEY));

    }


}