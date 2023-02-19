<?php

namespace Themosis\BeeRH\Providers\Admin;

use Illuminate\Support\ServiceProvider;
use Themosis\Support\Facades\Action;

class OptionPageServiceProvider extends ServiceProvider
{
    public function register()
    {
        Action::add('admin_menu', [$this, 'add_settings_page']);
    }

    public function add_settings_page()
    {
        add_options_page(
            'Amphibee RH',      // Titre de la page de réglages
            'Amphibee RH',      // Titre du menu
            'manage_options',   // Capacité requise pour accéder à la page
            'amphibee-rh',      // Slug de la page de réglages
            function(){
                echo view('admin.single');
            }
        );
    }
}