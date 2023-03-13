<?php

namespace Themosis\BeeRH\Providers;

use Illuminate\Session\SessionServiceProvider as BaseSessionServiceProvider;

class SessionServiceProvider extends BaseSessionServiceProvider
{
    protected function registerSessionManager()
    {
        $this->app->singleton('session', function ($app) {
            return new \Illuminate\Session\SessionManager($app);
        });
    }
}
