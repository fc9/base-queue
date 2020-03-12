<?php

namespace Fc9\Queue\Providers;

use Illuminate\Database\Eloquent\Factory;
use Illuminate\Support\ServiceProvider;

class QueueServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        $this->registerConfig();
        $this->registerFactories();
        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        $this->app->register(RouteServiceProvider::class);

        // Register the main class to use with the facade
        $this->app->singleton('queue', function () {
            return new \Fc9\Queue\Queue();
        });
    }

    /**
     * Register Config.
     *
     * @return void
     */
    protected function registerConfig()
    {
        $this->publishes([__DIR__ . '/../config/queue.php' => config_path('queue.php'),], 'Config');

        $this->mergeConfigFrom(__DIR__ . '/../config/queue.php', 'queue');
    }

    /**
     * Register an additional directory of factories.
     *
     * @return void
     */
    public function registerFactories()
    {
        if (!app()->environment('production') && $this->app->runningInConsole()) {
            app(Factory::class)->load(__DIR__ . '/../database/factories');
        }
    }
}
