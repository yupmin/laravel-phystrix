<?php

declare(strict_types=1);

namespace Tests;

use Odesk\Phystrix;

class ServiceProviderTest extends TestCase
{
    public function testResolve(): void
    {
        $commandFactory = $this->app->make(Phystrix\CommandFactory::class);

        $this->assertInstanceOf(Phystrix\CommandFactory::class, $commandFactory);

        $commandFactory = $this->app->make(Phystrix\MetricsEventStream\MetricsServer::class);

        $this->assertInstanceOf(Phystrix\MetricsEventStream\MetricsServer::class, $commandFactory);
    }
}