<?php

declare(strict_types=1);

namespace Keboola\HelloWorldBref;

class App
{
    public function getHelloWorld($event)
    {
        return sprintf('Hello %s', $event['pathParameters']['name']);
    }

    public function postHelloWorld($event)
    {
        $body = json_decode($event['body'], true);
        return sprintf('Hello %s', $body['name']);
    }
}
