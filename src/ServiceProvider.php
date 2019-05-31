<?php

namespace Yupmin\Phystrix;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Support\ServiceProvider as BaseServiceProvider;
use Odesk\Phystrix;
use Yupmin\Phystrix\Console\Commands\MakePhystrixCommand;
use Zend\Config\Config;
use Illuminate\Foundation\Application as LaravelApplication;

class ServiceProvider extends BaseServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $source = realpath(__DIR__.'/../config/phystrix.php');
        if ($this->app instanceof LaravelApplication) {
            $this->publishes([$source => config_path('phystrix.php')]);
        }

        $this->mergeConfigFrom($source, 'phystrix');

        if ($this->app->runningInConsole()) {
            $this->commands([
                MakePhystrixCommand::class,
            ]);
        }
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(Phystrix\CommandFactory::class, function ($app) {
            /** @var Application $app */
            $config = new Config($app['config']['phystrix']);
            /** @var Phystrix\StateStorageInterface $stateStorage */
            $stateStorage = $app->make('phystrix.state-storage.'.$config['stage_storage_type']);

            return new Phystrix\CommandFactory(
                $config,
                new Phystrix\CircuitBreakerFactory($stateStorage),
                new Phystrix\CommandMetricsFactory($stateStorage),
                new Phystrix\RequestCache(),
                new Phystrix\RequestLog()
            );
        });
        $this->app->alias(Phystrix\CommandFactory::class, 'phystrix.command-factory');
        $this->app->alias(Phystrix\ArrayStateStorage::class, 'phystrix.state-storage.array');
        $this->app->alias(Phystrix\ApcStateStorage::class, 'phystrix.state-storage.apc');
    }
}
