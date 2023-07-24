<?php

require_once '../../vendor/autoload.php';

$conf = new RdKafka\Conf();
$conf->set('metadata.broker.list', 'kafka:9092');

$producer = new RdKafka\Producer($conf);
$topic = $producer->newTopic('test-topic4');
$payload = 'Hello, Kafka!'; // Содержимое сообщения
$key = 'message_key_1'; // Ключ сообщения (опционально)

$topic->produce(RD_KAFKA_PARTITION_UA, 0, $payload, $key);

while ($producer->getOutQLen() > 0) {
    $producer->poll(50);
}

echo 'Message sent successfully: ' . $payload . PHP_EOL;
