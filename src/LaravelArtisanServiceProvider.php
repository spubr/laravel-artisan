<?php

namespace LeBarbuCodeur\LaravelArtisan;

use Illuminate\Support\ServiceProvider;

class LaravelArtisanServiceProvider extends ServiceProvider
{
    public string $namespace = 'laravel-artisan';

    public function boot()
    {
        $this->registerRoutesPath();
        $this->registerTranslationsPath();
        $this->registerViewComposer();
        $this->registerViewsPath();

        $this->publishes([
            sprintf('%s/lang', __DIR__) => $this->app->langPath(
                sprintf('vendor/%s', $this->namespace),
            ),
        ]);
    }

    protected function getBaseUrlFromServer(): string
    {
        $scheme = (! empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off')
            ? 'https'
            : 'http';
        $host = $_SERVER['HTTP_HOST'] ?? 'localhost';

        return $scheme.'://'.$host;
    }

    public function register()
    {
        $this->app->bind('laravel-artisan', fn () => new LaravelArtisan());
    }

    protected function registerRoutesPath(): void
    {
        $this->loadRoutesFrom(sprintf('%s/LaravelArtisanRoutes.php', __DIR__));
    }

    protected function registerTranslationsPath(): void
    {
        $this->loadTranslationsFrom(sprintf('%s/lang', __DIR__), $this->namespace);
    }

    protected function registerViewComposer(): void
    {
        $this->app['view']->composer(
            sprintf('%s::*', $this->namespace),
            function ($view): void {
                $view->with('baseUrl', $this->getBaseUrlFromServer());
            }
        );
    }

    protected function registerViewsPath(): void
    {
        $this->loadViewsFrom(sprintf('%s/views', __DIR__), $this->namespace);
    }
}