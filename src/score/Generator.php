<?php
/**
 * Created by PhpStorm.
 * User: Jenner
 * Date: 2016/3/18
 * Time: 21:00
 */

namespace jenner\redis\study\score;


use jenner\redis\study\tool\Logger;

class Generator
{
    protected $target;

    public function __construct($target)
    {
        if (!file_exists($target)) {
            unlink($target);
        }
        $this->target = $target;
    }

    public function generate()
    {
        $start_date = "2016-03-01 00:00:00";
        $end_date = "2016-03-18 00:00:00";
        while (strtotime($start_date) <= strtotime($end_date)) {
            Logger::info($start_date);
            $count = 1000;
            for ($i = 0; $i < $count; $i++) {
                $user_name = md5(mt_rand(0, 100000));
                $payment = mt_rand(0, 10000);
                $line = $start_date . "\t" . $user_name . "\t" . $payment . PHP_EOL;
                file_put_contents($this->target, $line, FILE_APPEND);
            }

            $start_date = date("Y-m-d H:i:s", strtotime($start_date . ' +1 Day'));
        }
    }
}