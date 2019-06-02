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
            $config = $app['config']['phystrix'];
            /** @var Phystrix\StateStorageInterface $stateStorage */
            $stateStorage = $app->make('phystrix.state-storage.'.$config['state_storage_type']);

            return new Phystrix\CommandFactory(
                new Config($config),
                new Phystrix\CircuitBreakerFactory($stateStorage),
                new Phystrix\CommandMetricsFactory($stateStorage),
                new Phystrix\RequestCache(),
                new Phystrix\RequestLog()
            );
        });
        $this->app->singleton(Phystrix\MetricsEventStream\MetricsServer::class, function ($app) {
            /** @var Application $app */
            $config = $app['config']['phystrix'];

            /** @var Phystrix\MetricsEventStream\MetricsPollerInterface $metricsPoller */
            $metricsPoller = $app->make('phystrix.metrics-event-stream.'.$config['state_storage_type'], [
                'config' => new Config($config)
            ]);

            return new Phystrix\MetricsEventStream\MetricsServer($metricsPoller);
        });
        $this->app->alias(Phystrix\CommandFactory::class, 'phystrix.command-factory');
        $this->app->alias(Phystrix\MetricsEventStream\MetricsServer::class, 'phystrix.stream');
        $this->app->alias(Phystrix\ArrayStateStorage::class, 'phystrix.state-storage.array');
        $this->app->alias(Phystrix\ApcStateStorage::class, 'phystrix.state-storage.apcu');
        $this->app->alias(Phystrix\MetricsEventStream\ApcuMetricsPoller::class, 'phystrix.metrics-event-stream.apcu');
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [
            Phystrix\CommandFactory::class,
            Phystrix\MetricsEventStream\MetricsServer::class,
        ];
    }
}
