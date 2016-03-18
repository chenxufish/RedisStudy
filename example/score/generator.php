<?php
/**
 * Created by PhpStorm.
 * User: Jenner
 * Date: 2016/3/18
 * Time: 21:04
 */

require dirname(__DIR__) . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php';

$score_file = dirname(dirname(__DIR__)) . DIRECTORY_SEPARATOR . 'resource' . DIRECTORY_SEPARATOR .'payment.log';
$generator = new \jenner\redis\study\score\Generator($score_file);
$generator->generate();