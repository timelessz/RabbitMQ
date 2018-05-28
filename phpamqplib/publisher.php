<?php
/**
 * Created by PhpStorm.
 * User: timeless
 * Date: 18-4-28
 * Time: 上午11:56
 */
require_once '../vendor/autoload.php';

use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

$connection = new AMQPStreamConnection('localhost', 5672, 'guest', 'guest');
$channel = $connection->channel();
$channel->queue_declare('hello', false, false, false, false);

$channel->exchange_declare('logs', 'fanout', false, false, false);

$msg = new AMQPMessage('Hello World!');
$channel->basic_publish($msg, '', 'hello');
$channel->close();
$connection->close();