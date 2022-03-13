<?php


namespace TendoPay\Integration\XenConnex;

use GuzzleHttp\Client;
use Illuminate\Foundation\Application;
use Illuminate\Support\ServiceProvider;
use TendoPay\Integration\XenConnex\Api\CustomersService;
use TendoPay\Integration\XenConnex\Api\EndpointCaller;
use TendoPay\Integration\XenConnex\Api\IdentityService;
use TendoPay\Integration\XenConnex\Api\LinkTokensService;
use TendoPay\Integration\XenConnex\Api\TransactionsService;

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

        $this->app->singleton(CustomersService::class);
        $this->app->singleton(LinkTokensService::class);
        $this->app->singleton(TransactionsService::class);
        $this->app->singleton(IdentityService::class);
    }
}
