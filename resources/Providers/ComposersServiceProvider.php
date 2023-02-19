<?php

namespace Themosis\BeeRH\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Themosis\BeeRH\Composers\QuizzSingle;

class ComposersServiceProvider extends ServiceProvider
{
    public function register()
    {
        View::composers(
            [
                QuizzSingle::class => '*',
            ]
        );
    }
}
