<?php

namespace Themosis\BeeRH\Providers;

use Themosis\Core\Support\Providers\RouteServiceProvider as ServiceProvider;
use Themosis\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * Controller namespace for plugin routes.
     *
     * @var string
     */
    protected $namespace = 'Bee_RH';

    public function boot()
    {
        parent::boot();
    }

    /**
     * Load plugin routes.
     */
    public function map()
    {
        $pluginName = ltrim(
            str_replace(plugins_path(), '', realpath(__DIR__.'/../../')),
            '\/'
        );
        Route::middleware('web')
            ->namespace($this->namespace)
            ->group(plugins_path($pluginName.'/routes.php'));
    }
}
