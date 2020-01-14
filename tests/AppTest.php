<?php

declare(strict_types=1);

namespace Keboola\HelloWorldBref\Tests;

use Keboola\HelloWorldBref\App;
use PHPUnit\Framework\TestCase;

class AppTest extends TestCase
{
    public function testGetHelloWorld()
    {
        $app = new App();
        $event = [
            'pathParameters' => [
                'name' => 'miro'
            ]
        ];

        $this->assertEquals('Hello miro', $app->getHelloWorld($event));
    }

    public function testPostHelloWorld()
    {
        $app = new App();
        $event = [
            'body' => json_encode([
                'name' => 'miro'
            ])
        ];

        $this->assertEquals('Hello miro', $app->postHelloWorld($event));
    }
}
