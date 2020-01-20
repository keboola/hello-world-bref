<?php

declare(strict_types=1);

use Keboola\HelloWorldBref\App;

require __DIR__.'/vendor/autoload.php';

lambda(function ($event) {
    $app = new App();

    $resourceMap = [
        '/{name}' => [
            'GET' => function ($event) use ($app): array {
                return [
                    'statusCode' => 200,
                    'body' => json_encode($app->getHelloWorld($event)),
                ];
            },
        ],
        '/' => [
            'POST' => function ($event) use ($app): array {
                return [
                    'statusCode' => 201,
                    'body' => json_encode($app->postHelloWorld($event)),
                ];
            },
        ],
    ];

    try {
        if (empty($event['httpMethod']) || empty($event['resource'])) {
            throw new \Exception('Bad Request', 400);
        }
        if (empty($resourceMap[$event['resource']])) {
            throw new \Exception('Route Not Found', 404);
        }
        $resource = $resourceMap[$event['resource']];
        if (empty($resource[$event['httpMethod']])) {
            throw new \Exception('Method Not Allowed', 405);
        }
        $actionFn = $resource[$event['httpMethod']];

        return $actionFn($event);
    } catch (\Throwable $e) {
        return [
            'statusCode' => 500,
            'body' => json_encode([
                'errorMessage' => $e->getMessage(),
            ])
        ];
    }
});
