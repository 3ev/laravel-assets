<?php
namespace Tev\Assets\Providers;

use Illuminate\Support\ServiceProvider;

/**
 * Service provider for the asset library.
 */
class AssetsServiceProvider extends ServiceProvider
{
    /**
     * {@inheritdoc}
     */
    public function register()
    {
        $this->app->singleton('Tev\Assets\LoaderInterface', function($app) {
            return new Loader(
                '/build/assets',
                public_path() . '/build/assets/rev-manifest.json'
            );
        });
    }
}
