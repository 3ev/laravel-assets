<?php
namespace Tev\Assets\Providers;

use Tev\Assets\Loader;
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
                config('tev_assets.asset_path'),
                config('tev_assets.manifest_path'),
                config('tev_assets.asset_url')
            );
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/../../../config.php' => config_path('tev_assets.php')
        ]);
    }
}
