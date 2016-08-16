<?php
/**
 * Created by PhpStorm.
 * User: huyanping
 * Date: 16/8/16
 * Time: 下午4:54
 */

// 消费者
$redis = new Redis();
$redis->connect("127.0.0.1");

while($redis->lLen("queue") > 0) {
    $record = $redis->rPop("queue");
    // do something with $record...
    sleep(1);
}


// 批量出队列
$redis->multi(Redis::PIPELINE);
for($i=0; $i<200; $i++) {
    $redis->rPop("queue");
}
$result = $redis->exec();
// do some thing with $result
// ...

