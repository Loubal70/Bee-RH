<?php

namespace Themosis\BeeRH\Providers\Admin;

use Illuminate\Support\ServiceProvider;
use Themosis\Support\Facades\Action;
use Illuminate\Support\Facades\DB;

class OptionPageServiceProvider extends ServiceProvider
{
    public function register()
    {
        Action::add('admin_menu', [$this, 'add_settings_page']);
        Action::add('admin_menu', [$this, 'add_employee_stats_page']);
    }

    public function add_settings_page()
    {
        add_options_page(
            __('Amphibee RH', BEE_RH_TD),      // Titre de la page de réglages
            __('Amphibee RH', BEE_RH_TD),      // Titre du menu
            __('manage_options', BEE_RH_TD),   // Capacité requise pour accéder à la page
            __('amphibee-rh', BEE_RH_TD),      // Slug de la page de réglages
            function () {
                echo view('admin.single');
            }
        );
    }

    public function add_employee_stats_page()
    {
        add_submenu_page(
            '',
            __('Statistiques employé', BEE_RH_TD),
            '',
            __('manage_options', BEE_RH_TD),
            __('employee-stats', BEE_RH_TD),
            [$this, 'display_employee_stats']
        );
    }

    public function display_employee_stats()
    {
        // Récupérer l'identifiant de l'employé depuis l'URL
        $employee_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

        $db = connectionDatabase();
        if(!empty($db['error_log'])){
            echo view('error', ['error' => $db['error_log']]);
            die;
        } elseif($employee_id === 0){
            echo view('error', ['error' => __('Désolé, je n\'arrive pas à trouver l\'employé(e) que vous demandez', BEE_RH_TD)]);
            die;
        }
        $employee = DB::table( 'rh_questionnaires')->where('user_id', $employee_id)->first();
        echo view('admin.employee.single', ['employee' => $employee]);
    }
}