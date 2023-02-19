<?php

namespace Themosis\BeeRH\Providers\Admin;

use Illuminate\Support\ServiceProvider;
use Themosis\Support\Facades\Action;

class RoleServiceProvider extends ServiceProvider
{
    public function register()
    {
        Action::add('admin_init', [$this, 'add_employees_role']);
    }

    public function add_employees_role()
    {
        add_role(
            'employees', // identifiant du rôle, en minuscules et sans espaces
            __('Employé / Employée', BEE_RH_TD), // nom du rôle affiché dans l'interface d'administration
            array(
                'read' => true,
            )
        );
    }
}