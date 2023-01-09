<?php

declare(strict_types=1);

namespace Tests;

use Orchestra\Testbench\TestCase as OrchestraTestCase;
use Yupmin\Phystrix\ServiceProvider;

class TestCase extends OrchestraTestCase
{
    /**
     * Get package providers.
     *
     * @param  \Illuminate\Foundation\Application  $app
     *
     * @return array<int, string>
     */
    protected function getPackageProviders($app)
    {
        return [
            ServiceProvider::class,
        ];
    }
}
