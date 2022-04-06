<?php

namespace App\Support\PubSub;

use Exception;
use Illuminate\Support\Facades\DB;

final class DatabasePubSub implements PubSubContract
{
    public function publish(array $routingKey, array $data)
    {
        foreach ($routingKey as $route) {
            DB::table('pubsub')->insert([
                'queue' => config('app.name'),
                'routing_key' => $route,
                'data' => json_encode($data),
            ]);
        }
    }

    public function consume(string $queue, array $routingKey, object $action)
    {
        throw new Exception('do not implemented');
    }
}
