<?php

namespace App\Support\PubSub;

use Exception;

final class RabbitMQPubSub implements PubSubContract
{
    public function publish(array $routingKey, array $data)
    {
        throw new Exception('do not implemented');
    }

    public function consume(string $queue, array $routingKey, object $action)
    {
        throw new Exception('do not implemented');
    }
}
