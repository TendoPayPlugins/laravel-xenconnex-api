<?php


namespace TendoPay\Integration\XenConnex;

use GuzzleHttp\Client;
use Illuminate\Foundation\Application;
use Illuminate\Support\ServiceProvider;
use TendoPay\Integration\XenConnex\Api\CustomerService;
use TendoPay\Integration\XenConnex\Api\EndpointCaller;

class XenConnexServiceProvider extends ServiceProvider
{
    /**
     * Loads the configuration file.
     *
     * @return void
     */
    public function boot()
    {
        $this->mergeConfigFrom(__DIR__.'/../../../../config/xenconnex.php', 'xenconnex');
    }

    /**
     * Register bindings in the container.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(EndpointCaller::class, function (Application $app) {
            return new EndpointCaller(
                new Client(),
                config("xenconnex.url"),
                config("xenconnex.api_key")
            );
        });

        $this->app->singleton(CustomerService::class);
    }
}
