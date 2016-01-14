<?php

namespace TwoMedia\TelSearch;

use Illuminate\Support\ServiceProvider;
use Illuminate\View\Compilers\BladeCompiler;
use TwoMedia\TelSearch\Client as Client;

class TelSearchServiceProvider extends ServiceProvider
{
    /**
     * Register the application services.
     */
    public function register()
    {
        $this->app->bind('TwoMedia\TelSearch\Client', function ($app) {

            $apiKey = $this->app['config']->get('services.tel-search.secret');
            $client =  new Client();
            $client->setKey($apiKey);

            return $client;
        });
    }
}
