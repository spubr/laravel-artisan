<?php

namespace LeBarbuCodeur\LaravelArtisan\Tests;

use LeBarbuCodeur\LaravelArtisan\LaravelArtisan;
use LeBarbuCodeur\LaravelArtisan\LaravelArtisanFacade;
use LeBarbuCodeur\LaravelArtisan\LaravelArtisanServiceProvider;

abstract class TestCase extends \Orchestra\Testbench\TestCase
{
    protected function defineWebRoutes($router)
    {
        $router->prefix('artisan')->name('laravel-artisan.')->group(function () use ($router) {
            $router->get('', [LaravelArtisan::class, 'list'])->name('list');
            $router->get('/{command}', [LaravelArtisan::class, 'play'])->name('play');
        });
    }

    protected function getEnvironmentSetUp($app)
    {
        $app->instance('routes.cached', false);
        $app['config']->set('app.key', 'base64:'.base64_encode(random_bytes(32)));
    }

    protected function getPackageProviders($app)
    {
        return [
            LaravelArtisanServiceProvider::class,
        ];
    }

    protected function getPackageAliases($app)
    {
        return [
            'LaravelArtisanFacade' => LaravelArtisanFacade::class,
        ];
    }
}
