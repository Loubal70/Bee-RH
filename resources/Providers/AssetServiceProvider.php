<?php

namespace Themosis\BeeRH\Providers;

use Illuminate\Support\ServiceProvider;
use Themosis\Support\Facades\Asset;

class AssetServiceProvider extends ServiceProvider
{
    /**
     * Theme Assets
     *
     * Here we define the loaded assets from our previously defined
     * "dist" directory. Assets sources are located under the root "assets"
     * directory and are then compiled, thanks to Laravel Mix, to the "dist"
     * folder.
     *
     * @see https://laravel-mix.com/
     */
    public function register()
    {
        /** @var PluginManager $plugin */
        $plugin = $this->app->make('wp.plugin.bee-rh');

        Asset::add('bee-rh', $plugin->getUrl('dist/css/bee-rh.css'), [], $plugin->getHeader('version'))->to('front');

        if ( is_admin() && isset($_GET['page']) && $_GET['page'] === 'amphibee-rh' ) {
            Asset::add('bee-rh', $plugin->getUrl('dist/css/bee-rh.css'), [], $plugin->getHeader('version'))->to('admin');
        }
    }
}
